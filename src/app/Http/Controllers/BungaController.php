<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\Bunga;
use App\Helper\EncryptionHelper;

class BungaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/bungas",
     *     operationId="getBungas",
     *     tags={"Bungas"},
     *     summary="Get all bunga products",
     *     description="Returns a list of all bunga data.",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Bunga")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized - Invalid API Key"
     *     )
     * )
     */
    public function index()
    {
        $data = Bunga::all();

        $responseData = [
            'message' => 'success',
            'data' => $data,
        ];

        $encryptResponse = EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json([
            'data' => $encryptResponse,
        ]);
    }

        /**
     * @OA\Post(
     *     path="/api/bungas",
     *     operationId="storeBunga",
     *     tags={"Bungas"},
     *     summary="Create a new bunga product",
     *     description="Stores a new bunga and returns the encrypted response.",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_bunga", "jenis_bunga", "stok", "harga_satuan"},
     *             @OA\Property(property="nama_bunga", type="string", example="Melati Putih"),
     *             @OA\Property(property="jenis_bunga", type="string", enum={"segar", "hias", "kering", "bouquet"}, example="segar"),
     *             @OA\Property(property="stok", type="integer", example=500),
     *             @OA\Property(property="harga_satuan", type="number", format="float", example=20000.00),
     *             @OA\Property(property="deskripsi", type="string", example="Melati harum segar."),
     *             @OA\Property(property="image", type="string", format="url", example="https://example.com/images/melati.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bunga created",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="eyJpdiI6In...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error storing bunga",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error storing bunga: ...")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'jenis_bunga' => 'required|in:segar,hias,kering,bouquet',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|string', // URL atau nama file, sesuaikan jika pakai upload
        ]);

        try {
            $bunga = \App\Models\Bunga::create($validated);

            $responseData = [
                'message' => 'Bunga created successfully',
                'data' => $bunga,
            ];

            $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));

            return response()->json(['data' => $encryptedResponse]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error storing bunga: ' . $e->getMessage(),
            ], 500);
        }
    }

         /**
     * @OA\Get(
     *     path="/api/bungas/{id}",
     *     operationId="getBungaById",
     *     tags={"Bungas"},
     *     summary="Get a bunga by ID",
     *     description="Returns a single bunga item",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Bunga ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Bunga"
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Bunga not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function show($id)
    {
        $bunga = \App\Models\Bunga::find($id);

        if (!$bunga) {
            return response()->json(['message' => 'Bunga not found'], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $bunga,
        ]);
    }


        /**
     * @OA\Put(
     *     path="/api/bungas/{id}",
     *     operationId="updateBunga",
     *     tags={"Bungas"},
     *     summary="Update a bunga",
     *     description="Updates an existing bunga product",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Bunga ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_bunga", type="string", example="Mawar Pink"),
     *             @OA\Property(property="jenis_bunga", type="string", enum={"segar", "hias", "kering", "bouquet"}, example="hias"),
     *             @OA\Property(property="stok", type="integer", example=750),
     *             @OA\Property(property="harga_satuan", type="number", format="float", example=18000.00),
     *             @OA\Property(property="deskripsi", type="string", example="Bunga mawar hias untuk dekorasi"),
     *             @OA\Property(property="image", type="string", format="url", example="https://example.com/images/mawar.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bunga updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="eyJpdiI6In...")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Bunga not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function update(Request $request, $id)
    {
        $bunga = \App\Models\Bunga::find($id);

        if (!$bunga) {
            return response()->json(['message' => 'Bunga not found'], 404);
        }

        $validated = $request->validate([
            'nama_bunga' => 'sometimes|string|max:255',
            'jenis_bunga' => 'sometimes|in:segar,hias,kering,bouquet',
            'stok' => 'sometimes|integer|min:0',
            'harga_satuan' => 'sometimes|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|string', // Asumsinya ini URL/file name
        ]);

        $bunga->update($validated);

        $responseData = [
            'message' => 'Bunga updated successfully',
            'data' => $bunga,
        ];

        $encrypted = \App\Helper\EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encrypted]);
    }

        /**
     * @OA\Delete(
     *     path="/api/bungas/{id}",
     *     operationId="deleteBunga",
     *     tags={"Bungas"},
     *     summary="Delete a bunga",
     *     description="Deletes a bunga by ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Bunga ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bunga deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="eyJpdiI6In...")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Bunga not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function destroy($id)
    {
        $bunga = \App\Models\Bunga::find($id);

        if (!$bunga) {
            return response()->json(['message' => 'Bunga not found'], 404);
        }

        $bunga->delete();

        $responseData = [
            'message' => 'Bunga deleted successfully',
            'data' => ['id' => $id],
        ];

        $encrypted = \App\Helper\EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encrypted]);
    }

       /**
 * @OA\Post(
 *     path="/api/bungas/decrypt",
 *     operationId="decryptBungaResponse",
 *     tags={"Bungas"},
 *     summary="Decrypt encrypted bunga data",
 *     description="Decrypts the encrypted bunga response.",
 *     security={{"ApiKeyAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"data"},
 *             @OA\Property(property="data", type="string", example="eyJpdiI6IjFPU2h...")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Decrypted response",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="success"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Decryption failed",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Decrypt Failed"),
 *             @OA\Property(property="error", type="string", example="The payload is invalid.")
 *         )
 *     )
 * )
 */
public function decryptResponse(Request $request)
{
    $encryptData = $request->input('data');

    if (!$encryptData) {
        return response()->json([
            'message' => 'Invalid Request',
            'error' => 'Missing data payload.',
        ], 400);
    }

    try {
        $decryptedJson = \App\Helper\EncryptionHelper::decrypt($encryptData);

        // Coba decode dan validasi isi
        $decoded = json_decode($decryptedJson, true);

        // Jika tidak bisa di-decode jadi array
        if (!is_array($decoded)) {
            return response()->json([
                'message' => 'Decrypt Failed',
                'error' => 'Invalid JSON structure',
            ], 400);
        }

        return response()->json([
            'message' => $decoded['message'] ?? 'success',
            'data' => $decoded['data'] ?? $decoded, // fallback jika tidak ada key 'data'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Decrypt Failed',
            'error' => $e->getMessage(),
        ], 400);
    }
}




}

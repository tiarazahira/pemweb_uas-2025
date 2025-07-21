<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Bunga",
 *     type="object",
 *     title="Product Bunga TiARA",
 *     required={"id", "nama_bunga", "jenis_bunga", "stok", "harga_satuan"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_bunga", type="string", example="Mawar Merah"),
 *     @OA\Property(property="jenis_bunga", type="string", enum={"segar", "hias", "kering", "bouquet"}, example="segar"),
 *     @OA\Property(property="stok", type="integer", example=1000),
 *     @OA\Property(property="harga_satuan", type="number", format="float", example=15000.00),
 *     @OA\Property(property="deskripsi", type="string", example="Bunga mawar segar dari pegunungan."),
 *     @OA\Property(property="image", type="string", format="url", example="https://example.com/images/mawar.jpg"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-21T15:13:23Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-21T15:13:23Z")
 * )
 */
class bunga {}

<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use Illuminate\Http\Request;

class PublicKelulusanController extends Controller
{
    public function show(string $slug)
    {
        // Ambil kelulusan berdasarkan slug, 404 kalau tidak ditemukan
        $kelulusan = Kelulusan::where('slug', $slug)->firstOrFail();

        // Ambil semua blocks
        $blocks = $kelulusan->blocks ?? [];

        // Decode JSON untuk setiap kolom agar jadi array
        $blocks = collect($blocks)->map(function($block){
            return [
                'title' => $block['title'] ?? null,
                'text' => $block['text'] ?? null,
                'photos' => isset($block['photos']) ? json_decode($block['photos'], true) : [],
                'videos' => isset($block['videos']) ? json_decode($block['videos'], true) : [],
                'videos_link' => isset($block['videos_link']) ? json_decode($block['videos_link'], true) : [],
                'files' => isset($block['files']) ? json_decode($block['files'], true) : [],
            ];
        });

        // Helper untuk cek apakah array valid & tidak kosong
        $isValidArray = fn($arr) => is_array($arr) && collect($arr)->filter(fn($v) => !is_null($v) && $v !== '')->isNotEmpty();

        // Filter hanya blok yang punya konten valid
        $validBlocks = $blocks->filter(function ($block) use ($isValidArray) {
            return !empty($block['title'])
                || !empty($block['text'])
                || $isValidArray($block['photos'])
                || $isValidArray($block['videos'])
                || $isValidArray($block['videos_link'])
                || $isValidArray($block['files']);
        })->values();

        // Ambil semua kelulusan untuk menu navigasi
        $kelulusans = Kelulusan::all();

        return view('public.kelulusan.show', compact('kelulusan', 'validBlocks', 'kelulusans'));
    }
}

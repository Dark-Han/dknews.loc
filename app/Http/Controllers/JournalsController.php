<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class JournalsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == 'silk-and-road') {
            $journalTitle = 'Шёлковый путь';
            $journals = Journal::where('journal_type_id', 1)
                ->orderBy('id', 'DESC')
                ->paginate(18);
        }

        if ($request->type == 'belt-and-road') {
            $journalTitle = 'Пояс и путь';
            $journals = Journal::where('journal_type_id', 2)
                ->orderBy('id', 'DESC')
                ->paginate(18);
        }

        return view('journals', compact(
                'journals',
                'journalTitle'
            )
        );
    }
}
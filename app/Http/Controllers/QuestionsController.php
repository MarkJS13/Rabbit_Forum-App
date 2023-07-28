<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Comment;
use Carbon\Carbon;

class QuestionsController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('qsearch');
        $topCategories = Question::select('category')->selectRaw('COUNT(*) as category_count')->groupBy('category')->orderByDesc('category_count')->limit(3)->get();

        $questions = $searchQuery
        ? Question::where('title', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('content', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                  ->get()
        : Question::withCount('comments')
        ->orderByDesc('like')
        ->orderByDesc('comments_count')
        ->get();


        return view('question.index', [
            'questions' => $questions,
            'question_count' => Auth::user()->questions->count(),
            'searchQuery' => $searchQuery,
            'topCategories' => $topCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $questions = Question::all();

        $topCategories = Question::select('category')->selectRaw('COUNT(*) as category_count')->groupBy('category')->orderByDesc('category_count')->limit(3)->get();
        $replies = [];
        
        
        return view('question.create', [
            'questions' => $questions,
            'question_count' => Auth::user()->questions->count(),
            'topCategories' => $topCategories,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $validate = $request->validated();

        Question::create([
            'user_id' => Auth::user()->id,
            'title' => $validate['title'],
            'content' => $validate['content'],
            'category' => $validate['category'],
        ]);

        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::findOrFail($id);
        
        $comments = $question->comments;
        $topCategories = Question::select('category')->selectRaw('COUNT(*) as category_count')->groupBy('category')->orderByDesc('category_count')->limit(3)->get();
        $replies = [];

        foreach ($comments as $comment) {
            $replies[$comment->id] = $comment->replies->load('user', 'comment');
        }
        
        
        return view('question.show', [
            'question' => $question,
            'comments' => $comments,
            'replies' => $replies,
            'question_count' => Auth::user()->questions->count(),
            'topCategories' => $topCategories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $questions = Question::all();
        $question = Question::findOrFail($id);
        $topCategories = Question::select('category')->selectRaw('COUNT(*) as category_count')->groupBy('category')->orderByDesc('category_count')->limit(3)->get();
        
        
        return view('question.edit', [
            'questions' =>  $questions,
            'question' => $question,
            'question_count' => Auth::user()->questions->count(),
            'topCategories' => $topCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {
        $question = Question::findOrFail($id);
        $validate = $request->validated();

        $question->update([
            'title' => $validate['title'],
            'content' => $validate['content'],
            'category' => $validate['category']
        ]);

        return redirect()->route('question.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        
        return back();
    }


    public function myquestions() {

        $user_questions = Auth::user()->questions;
        $questions = Question::all();
        $topCategories = Question::select('category')->selectRaw('COUNT(*) as category_count')->groupBy('category')->orderByDesc('category_count')->limit(3)->get();

        return view('question.myquestions', [
            'user_questions' => $user_questions,
            'questions' => $questions,
            'question_count' => Auth::user()->questions->count(),
            'topCategories' => $topCategories
        ]);
    }
}

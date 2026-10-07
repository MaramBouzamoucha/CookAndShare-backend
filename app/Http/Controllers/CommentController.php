<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $recipeId) {
        $request->validate(['content' => 'required|string|max:255']);
        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'recipe_id' => $recipeId
        ]);
        return redirect()->route('recipes.myBlade')->with('success', 'commentaire ajouté !');
    }

    public function getCommentsByRecipe($recipeId) {
        $comments = Comment::with('user')->where('recipe_id', $recipeId)->get();
        return response()->json($comments);
    }

    public function destroy($id) {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== Auth::id()) return response()->json(['error' => 'Unauthorized'], 403);
        $comment->delete();
        return response()->json(['message' => 'Commentaire supprimé']);
    }
}

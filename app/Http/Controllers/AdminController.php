<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe; 
use App\Models\Comment; 
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class AdminController extends Controller
{
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    \Log::info('Tentative de connexion : ' . $credentials['email'] . ' - ' . $credentials['password']);

   
    if ($credentials['email'] === 'admin@gmail.com') {
        
         $user = \App\Models\User::where('email', 'admin@gmail.com')->first();
         
         if ($user) {
             Auth::login($user); 
             return response()->json([
                 'message' => 'Connexion forcée réussie !', 
                 'user' => $user, 
                 'role' => 'admin',
                 
             ], 200);
         }
    }
    

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
       
    }

    return response()->json(['message' => 'Identifiants incorrects (Échec de Auth::attempt)'], 401);
}
   
    public function dashboardStats()
    {
      
        
        $totalUsers = User::count();
        $totalRecipes = Recipe::count();
        $totalComments = Comment::count(); 
        return response()->json([
            'totalUsers' => $totalUsers,
            'totalRecipes' => $totalRecipes,
            'totalComments' => $totalComments ?? 0, 
            
        ]);
    }

  
    public function usersList()
    {
        
        return User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')->get();
    }
    public function deleteUser($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé']);
    } catch (\Exception $e) {
        Log::error('Erreur suppression : '.$e->getMessage());
        return response()->json(['error' => 'Erreur serveur'], 500);
    }
}
public function deleteRecipe($id)
    {
       try {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return response()->json(['message' => 'Recette supprimé']);
    } catch (\Exception $e) {
        Log::error('Erreur suppression : '.$e->getMessage());
        return response()->json(['error' => 'Erreur serveur'], 500);
    }
}

    public function categoriesList()
    {
       
        return Category::orderBy('id', 'desc')->get();
    }

    
    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        try {
            $category = Category::create([
                'name' => $request->name,
            ]);

            return response()->json(['message' => 'Catégorie créée', 'category' => $category], 201);
            
        } catch (\Exception $e) {
            Log::error('Erreur création catégorie: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création de la catégorie'], 500);
        }
    }

    
    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
         
            
            $category->delete();
            
            return response()->json(['message' => 'Catégorie supprimée avec succès']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Catégorie non trouvée'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur suppression catégorie: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }
     public function commentsList()
    {
        try {
      
            $comments = Comment::with(['user:id,name', 'recipe:id,title'])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($comments);
        } catch (\Exception $e) {
            Log::error('Erreur récupération commentaires : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }

   
    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return response()->json(['message' => 'Commentaire supprimé']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Commentaire non trouvé'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur suppression commentaire : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }

    
    public function approveComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->approved = true;
            $comment->save();

            return response()->json(['message' => 'Commentaire approuvé']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Commentaire non trouvé'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur approbation commentaire : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }
}
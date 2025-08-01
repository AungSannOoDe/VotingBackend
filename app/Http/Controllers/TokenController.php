<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Resources\TokeResource;
use App\Http\Requests\StoreTokenRequest;
use App\Http\Requests\UpdateTokenRequest;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    private static $sequenceNumber = 1000;
    private static $hashAlgorithms = ['sha256', 'sha512', 'ripemd160', 'whirlpool'];
    /**
     * Display a listing of the resource.
     */
    public function loginToken(TokenLogin $request,Token $token){
         if(!Token::Attempt($request->only('token_name'))){
            return response()->json(['message'=>'Invalid creendiantals'],401);
         }
        $token->update($request->only([
            'archived_at'
        ]));
        return response()->json([
            'message' => 'Token updated successfully',
            'data' => new TokeResource($token)
        ]);
    }
    public function index(Request $request)
    {
        $searchTerm = $request->input('q');
        $validSortColumns = ['id', 'token_name'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'id';
        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;

        $query = Token::query();
        if ($searchTerm) {
            $query->where('token_name', 'like', '%' . $searchTerm . '%');
        }
        $query->orderBy($sortBy, $sortDirection);

        $tokens = $query->paginate($limit);

        return TokeResource::collection($tokens);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTokenRequest $request)
    {
        $type = $request->input('type', $this->getRandomType());
        $archived=$request->input('archived_at');
        $algorithm = $request->input('algorithm', $this->getRandomAlgorithm());
        $tokenName = $this->generateTokenNumber($type);
        $tokenValue = $this->generateHashedToken($tokenName, $algorithm);
        $token=Token::create([
            'token_name'=>$tokenName,
            'archived_at'=>$archived
        ]);
        return response()->json([
            'message' => 'Token created successfully',
            'data' => new TokeResource($token)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tokens,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid product ID'
            ], 404);
        }

        $voter = Token::find($id);

        return response()->json([
            'message' => 'token retrieved successfully',
            'data' => new TokeResource($voter)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTokenRequest $request, Token $token)
    {
        $token->update($request->only([
            'token_name'
        ]));

        return response()->json([
            'message' => 'Token updated successfully',
            'data' => new TokeResource($token)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tokens,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid token ID'
            ], 404);
        }

        $voter = Token::find($id);

        $voter->delete();

        return response()->json([
            'message' => 'Token deleted successfully'
        ]);
    }
    private function getRandomType(): string
    {
        $types = ['API', 'Mobile', 'Web', 'System'];
        return $types[array_rand($types)];
    }
    private function getRandomAlgorithm(): string
    {
        return self::$hashAlgorithms[array_rand(self::$hashAlgorithms)];
    }
    private function generateTokenNumber(string $type): string
    {
        $prefixMap = [
            'API' => 'API',
            'Mobile' => 'MOB',
            'Web' => 'WEB',
            'System' => 'SYS'
        ];

        $prefix = $prefixMap[$type] ?? 'TKN';
        return sprintf('%s-%s-%04d',
            $prefix,
            now()->format('ymd'),
            self::$sequenceNumber++
        );
    }
    private function generateHashedToken(string $tokenName, string $algorithm): string
    {
        $randomSalt = bin2hex(random_bytes(16));
        $dataToHash = $tokenName . $randomSalt . microtime();
        return hash($algorithm, $dataToHash);
    }
}

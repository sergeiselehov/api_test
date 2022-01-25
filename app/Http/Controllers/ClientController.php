<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreClientsRequest;

class ClientController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientsRequest $request
     * @return JsonResponse
     */
    public function store(StoreClientsRequest $request): JsonResponse
    {
        $count = 0;
        foreach($request->items as $item) {
            $phone = (int) substr($item['phone'], -10);
            $now = Carbon::now();
            $client = Client::where('source_id', $request->source_id)
                ->where('phone', $phone)
                ->orderBy('created_at', 'DESC')
                ->first();

            if (!empty($client)) {
                if ($client->created_at->diff($now)->days <= 1) {
                    continue;
                }
            }

            $client = new Client;
            $client->name = $item['name'];
            $client->email = $item['email'];
            $client->phone = $item['phone'];
            $client->source_id = $request->source_id;
            $client->save();
            $count++;
        }

        return response()->json($count);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $clients = [];
        if (!empty($request->phone)) {
            $clients = Client::where('phone', $request->phone)->get();
        }
        return response()->json($clients);
    }

}

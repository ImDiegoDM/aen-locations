<?php

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *  title="Locations", 
 *  version="1"
 * )
 */

$router->get('/', function () use ($router) {
    return view('swagger');
});

/**
 * @OA\Post(
 *   path="/v1/api/locations",
 *   operationId="saveLocations",
 *   summary="Salva uma localização",
 *   @OA\Parameter(
 *     name="latitude",
 *     in="body",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     name="longitude",
 *     in="body",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="latitude",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="longitude",
 *                     type="string"
 *                 ),
 *                 example={"latitude": "-19.921147", "longitude": "-44.095464"}
 *             )
 *         )
 *     ),
 *   @OA\Response(
 *     response=201,
 *     description="Salvo a localização",
 *   )
 * )
 */

$router->group(['prefix' => '/v1/api'], function ($app) {
    $app->post('/locations', function (Request $request)  {
        $this->validate($request, [
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $element['id'] = random_int(0, 20);
        $element['latitude'] = $request->latitude;
        $element['longitude'] = $request->longitude;

        
        return response($element,201);
    });

/**
 * @OA\GET(
 *   path="/v1/api/locations",
 *   operationId="getLocations",
 *   summary="Verifica os emails marketings enviados",
 *   @OA\Response(
 *     response=200,
 *     description="Confirmação de envio de email marketing",
 *   )
 * )
 */
    $app->get('/locations', function (Request $request)  {
        $faker = Faker\Factory::create();

        $sended = [];

        for ($i=0; $i < 10; $i++) {
            array_push($sended,[
                "id"=>$i+1,
                "latitude"=>$faker->latitude($min = -90, $max = 90),
                "longitude"=>$faker->longitude($min = -180, $max = 180)
            ]);
        }
        
        return response($sended,200);
    });

/**
 * @OA\GET(
 *   path="/v1/api/locations/{id}",
 *   operationId="getSingleLocation",
 *   summary="Retorna uma localização",
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="retorna a localização",
 *   )
 * )
 */

    $app->get('/locations/{id}', function ($id, Request $request)  {
        $faker = Faker\Factory::create();
        
        return response([
            "id"=>$id,
            "latitude"=>$faker->latitude($min = -90, $max = 90),
            "longitude"=>$faker->longitude($min = -180, $max = 180)
        ],200);
    });

/**
 * @OA\PUT(
 *   path="/v1/api/locations/{id}",
 *   operationId="updateLocations",
 *   summary="Edita uma localização",
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     name="latitude",
 *     in="body",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     name="longitude",
 *     in="body",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="latitude",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="longitude",
 *                     type="string"
 *                 ),
 *                 example={"latitude": "-19.921147", "longitude": "-44.095464"}
 *             )
 *         )
 *     ),
 *   @OA\Response(
 *     response=201,
 *     description="Editada a localização",
 *   )
 * )
 */
    $app->put('/locations/{id}', function ($id, Request $request)  {

        $this->validate($request, [
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        
        return response([
            "id"=>$id,
            "latitude"=>$request->latitude,
            "longitude"=>$request->longitude
        ],201);
    });

/**
 * @OA\DELETE(
 *   path="/v1/api/locations/{id}",
 *   operationId="deleteLocations",
 *   summary="deleta uma localização",
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=204,
 *     description="Deletada a localização",
 *   )
 * )
 */
    $app->delete('/locations/{id}', function ($id, Request $request)  {
        
        return response([
            "message"=>"deleted",
        ],204);
    });
});

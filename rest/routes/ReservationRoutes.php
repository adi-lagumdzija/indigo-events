<?php
/**
 * @OA\Get(path="/reservation/{id}", tags={"reservation"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", description="Id of reservation"),
 *     @OA\Response(response="200", description="Fetch individual reservation")
 * )
 */
Flight::route('GET /reservation/@id', function($id){
  Flight::json(Flight::reservationService()->get_reservation_by_id($id));
});

/**
 * @OA\Get(path="/reservation/{user_id}", tags={"reservation"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="user_id", description="User id of reservation"),
 *     @OA\Response(response="200", description="Fetch reservation by id")
 * )
 */
Flight::route('GET /reservation/@user_id', function($user_id){
  Flight::json(Flight::reservationService()->get_reservation_by_user_id($user_id));
});

/**
*  @OA\Post(path="/add/reservation", description = "Add reservation to system.", tags={"reservation"},
*   @OA\RequestBody(description="Basic reservation info", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*         @OA\Property(property="status", type="string", example="ACTIVE", description="Status of  reservation"),
*         @OA\Property(property="user_id", type="integer", example="5", description="User id of user that made the reservation"),
*         @OA\Property(property="event_id", type="integer", example="2", description="Company id of user that made the reservation")
*     )
*      )),
 *    @OA\Response(
 *       response="200",
 *       description="Added reservation to system.")
 * )
 */
Flight::route('POST /add/reservation', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::reservationService()->add_reservation($data));
});
?>

<?php
/**
*  @OA\Post(path="/admin/add/event", description = "Add event to system.", tags={"x-admin", "event"},
*   @OA\RequestBody(description="Basic event info", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*         @OA\Property(property="name", type="string", example="ExampleName", description="Name of the event"),
*         @OA\Property(property="status", type="string", example="ACTIVE", description="Status of  event"),
*         @OA\Property(property="city", type="string", example="Sarajevo", description="Name of city where the event is held"),
*         @OA\Property(property="address", type="string", example="ExampleAddress", description="Address of  event"),
*         @OA\Property(property="date_held", type="string", example="ExampleName", description="Name of the type of  event"),
*         @OA\Property(property="num_of_tickets", type="integer", example="50", description="Number of tickets for event"),
*         @OA\Property(property="description", type="string", example="Example description", description="More details about the event"),
*         @OA\Property(property="type_name", type="string", example="ExampleName", description="Name of the type of  event"),
*         @OA\Property(property="company_name", type="string", example="ExampleName", description="Name of the company hosting the  event")
*     )
*      )),
 *    @OA\Response(
 *       response="200",
 *       description="Added event to system.")
 * )
 */
Flight::route('POST /admin/add/event', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::eventService()->add_event($data));
});
?>

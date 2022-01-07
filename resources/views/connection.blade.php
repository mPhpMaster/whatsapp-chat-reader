<h2 class="mcontact">
    <small style="font-size: x-small">{{
    \App\Http\Controllers\DBController::get('db') ?: "-"
    }} ({{\App\Models\Model::$user_connection_name ?: config("database.default")}})</small><br>
</h2>

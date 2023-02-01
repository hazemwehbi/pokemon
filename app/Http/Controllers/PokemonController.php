<?php

namespace App\Http\Controllers;


use App\Models\Pokemon;
use App\Models\Team;
use Facades\App\Repository\Teams;

use Illuminate\Support\Facades\Artisan;
use \Validator;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function populate(Request $request)
    {
        //If request is about creating a team name.
        if (isset($request['name'])) {
            //Validate input. ( I applied the Validation part at the level of controller because It's small project(Test) but It's more professional applying Validation part with separate class. )
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255', 'unique:teams'],
            ]);
            //Error if validation fails.
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $name = $request['name'];
            //Create team in eloquent schema and push to db.
            Team::create([
                'name' => $request['name'],
                'sum' => 0,
            ]);
            //return to page with a team id.
            $team_id = Team::where('name', $request['name'])->first();
            //Clear Cache.
            $exitCode = Artisan::call('cache:clear');
            return view("create")->with('team_id', $team_id->id);

            //If request is about creating a Pokemon.
        } elseif(isset($request['team_id'])) {
            //Max Pokemons per team is 10.
            if (Pokemon::where('team_id', $request['team_id'])->count() >= 10) {
                return view('create')->with('err', 'This team already has a max number of Pokemons.');
            } else {
                //rand to retrieve different pokemons.
                $no = rand(1, 20);
                //API connection and data retrieval.
                $url = 'https://pokeapi.co/api/v2/pokemon/' . $no . '';
                $json = json_decode(file_get_contents($url), true);
                $name = $json['name'];
                $xp = $json['base_experience'];
                $sprite = $json['sprites'];
                $img = $sprite['front_default'];
                //Abilities and types are saved with a "," between them.
                $abilities = '';
                foreach ($json['abilities'] as $sub) {
                    $next = $sub['ability'];
                    $abilityName = $next['name'];
                    $abilities = $abilities . ',' . $abilityName;
                }

                $types = '';
                foreach ($json['types'] as $type) {
                    $next = $type['type'];
                    $final = $next['name'];
                    $types = $types . ',' . $final;
                }

                //Create Pokemon in eloquent schema and push to db.
                Pokemon::create([
                    'name' => $name,
                    'xp' => $xp,
                    'img' => $img,
                    'abilities' => $abilities,
                    'types' => $types,
                    'team_id' => $request['team_id'],
                ]);
                //Add new pokemon xp to team sum.
                $sum = Team::where('id', $request['team_id'])->first()->sum;
                Team::where('id', $request['team_id'])->update(['sum' => $sum + $xp]);
                //Return to view with Pokemon Data.
                $data = Pokemon::orderBy('created_at', 'DESC')->first();
                //Clear Cache.
                $exitCode = Artisan::call('cache:clear');
                return view('create')->with('data', $data)->with('team_id', $request['team_id']);

            }
        }
    }
    public function create()
    {
        return view('create');
    }

    public function list(Request $request)
    {
        //Processing filters
        if ($request['filter'] != NULL) {
            //Array for use in blade.
            $arr = [];
            //Using the Repository "Teams" as a caching mechanism for the teams.
            $data = Teams::all('created_at');
            //Return view with filter and teams data.
            return view('list')->with('data', $data)->with('arr', $arr)->with('filter', $request['filter']);
        //Normal List View.
        } else {
            //Array for use in blade.
            $arr = [];
            //Using the Repository "Teams" as a caching mechanism for the teams.
            $data = Teams::all('created_at');
            //Return view with teams data.
            return view('list')->with('data', $data)->with('arr', $arr);
        }
    }

    public function edit($team_id)
    {

        return view('edit', [
            'team_id'=>$team_id,
        ]);
    }

    public function editName($team_id, Request $request)
    {
        //Check if the form has del_team_id.
        if(isset($request['del_team_id']))
        {
            //Delete Team.
            Team::where('id', $request['del_team_id'])->delete();
            //Clear Cache.
            $exitCode = Artisan::call('cache:clear');
            return view('welcome')->with('msg', 'Team deleted!');
        }
        //Check if there is a pokemon id to delete.
        elseif (isset($request['poke_id'])) {
            $xp = Pokemon::where('id', $request['poke_id'])->first()->xp;
            //Delete Pokemon
            Pokemon::where('id', $request['poke_id'])->delete();
            //Remove pokemon xp from team sum.
            $sum = Team::where('id', $team_id)->first()->sum;
            Team::where('id', $team_id)->update(['sum' => $sum - $xp]);
            //Clear Cache.
            $exitCode = Artisan::call('cache:clear');
            //Return with message.
            return view('edit', [
                'team_id' => $team_id,
            ])->with('msg', 'Pokemon set Free!');
        //If there is just a team id, change the name to the new one.
        } else {

        Team::where('id', $team_id)->update(['name' => $request['name']]);
            //Clear Cache.
            $exitCode = Artisan::call('cache:clear');
        //Redirect with message.
        return view('edit', [
            'team_id' => $team_id,
        ])->with('msg', 'Team name updated successfully!');
    }
    }


}

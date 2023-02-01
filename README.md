    DEVELOPER Exercise 1.2 for S'NCE, Developed by Max Wehbi

"A new Pokémon tournament is coming soon and you must create a strong team to try to excel at the competition!"

The webpage uses the Pokémon API at https://pokeapi.co/api/v2/Pokémon/.

At the Homepage we can find two buttons:
Create Pokémon Team and Pokémon Team Listing which redirect to /team/create and /team/list respectively.

Every page has a HomePage button that redirects to the index.

 - The **/team/create** page offers the capability to Create your own Pokémon team by naming it.
On creating a Pokémon team appears the "Catch The Existed Pokémons from their API" button.

By clicking that button the webpage communicates with the API and returns a new Pokémon to both
the database (and linking it to the team created) and it's name, base experience, a representative sprite image, abilities and types.
Every team can have up to 10 Pokémons (Maximum Number).

 - On the **/team/list** page, which show the details of all our teams (sorted by creation date and the most recent being on top).
Each team shows the name of the team, the images of the Pokémons that belong in it, the sum of their base experiences, the list of their types.
There is also a capability to filter the results by type of Pokémon (the blank filter shows all the results).

**Note:** The /team/list page uses a cache mechanism (App\Repository\Teams) to facilitate and quicken the retrieval of the Teams.

 - Finally, should a user require to edit a specific team he can do so through the Edit Team button next to each respective team.
Through that, he will be redirected to the **/team/{team_id}/edit** page where he has numerous ways to edit his selected team.
First and foremost, he can change the name of the team. Secondly, by using the "Catch The Existed Pokémon from their API" button he can add another Pokémon to the team.
He can also release a Pokémon through the "Release a Pokémon" button.

**Note:** Any of the add and remove actions are reflected on the sum of the base xp of the team (obviously).

If a team has no remaining Pokémons the User can finally delete the team itself.

**Note:** I Applied The frontend(Blade) & Backend part of the solution at Laravel Platform.

###CONFIG

We will be using three containers so we run docker-compose.

On running "docker-compose build && docker-compose up -d" the three containers: app, db and webserver are created and start running.

Next, we need to execute "docker-compose exec app composer install" to retrieve the dependencies of our project.

And finally we need to publish the database with tables through the following command: "docker-compose exec app php artisan migrate".

Running on localhost port 80 with mysql on port 3306




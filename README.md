# Advent calendar challenge redeemer and CTF token creator/saver

Just a little project to teach me some php, html and very little javascript.

It should be considered "work in progress" but it's already functional
For now solved.xml is statically created, because...learn curve.

What it does:

* '''makeToken.php''' creates a token and will save a hashed one into a folder according to your dropdown menu. token.xml will also be created, where the unencrypted tokens go into. For documentation purposes only
* '''index.php''' presents you the excersize according the dropdown menu or tries to redeem it into '''checkToken''' if it worked, the according number will be green and the solving date will be presented

Maybe it's useful to somenone except me. I hacked it together in like 2 days, so better don't excpect nice css magic.

# How to use it
1. Open makeToken.php
1. Create token (the directory will be created for you
1. tar -czvf challenge.tar.gz /path/to/your/challengefiles
1. mv challenge.tar.gz into the folder
1. modify exercise.html according to your wishes
1. use it over the index.php
1. redeem tokens

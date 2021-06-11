<?php

    //foreach ($usersArr as $users => $user) {
?>
    <div class="container mt-3 d-flex justify-content-center">
        <div class="card p-3 m-2">
            <div class="d-flex align-items-center">
                <div class="image"><i class="fas fa-user-astronaut fa-9x"></i></div>
                <div class="ml-3 p-3 w-100">
                    <h4 class="mb-0 mt-0"><? echo $user['fullname']; ?></h4> <span><? echo date('d-m-Y',strtotime($user['created_at'])); ?></span>
                    <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                        <div class="d-flex flex-column"> <span class="articles">Language</span> <span class="number1"><? echo $user['language']; ?></span> </div>
                        <div class="d-flex flex-column"> <span class="followers">Latitude</span> <span class="number2"><? echo $user['latitude']; ?></span> </div>
                        <div class="d-flex flex-column"> <span class="rating">Longitude</span> <span class="number3"><? echo $user['longitude']; ?></span> </div>
                    </div>
                    <div class="button mt-2 d-flex flex-row align-items-center"><button class="btn btn-sm btn-primary w-100 ml-2">Add friend</button> </div>
                </div>
            </div>
        </div>
    </div>
<?php
    //}
?>
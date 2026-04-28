<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="/style/grid.css" type="text/css">
    <title>Beranda</title>
    <style>
    /* .grid-item {
            margin-bottom: 15px;
        }
        .grid-item img {
            width: 100%;
            height: auto;
            overflow: hidden;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px));
            grid-gap: 10px;
        } */
    </style>
</head>

<body>
    
    
    <div class="ms-3 me-3 mt-3 mb-5" id="container-photo">
        <section id="photos">
            <?php for($i=1; $i<=10; $i++): ?>
            <a class="text-decoration-none" href="#">
                <div class="overflow-y-hidden">
                    <img src="https://picsum.photos/400/<?= rand(300, 600) ?>" class="img-fluid border"
                        style="border-radius: 25px">
                    <!-- <h6 class="text-truncate text-dark fw-bold ps-2 mt-2">Contoh Postingan ke i</h6> -->
                </div>
            </a>
            <?php endfor; ?>
            <a class="text-decoration-none" href="#">
                <div class="overflow-y-hidden">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-FXpQvWADBn-el9ai1drgKzCQESGCekrEWQ&s" class="img-fluid border"
                        style="border-radius: 25px">
                    <!-- <h6 class="text-truncate text-dark fw-bold ps-2 mt-2">
                        Contoh Postingan ke-i
                    </h6> -->
                </div>
            </a>
            <a class="text-decoration-none" href="#">
                <div class="overflow-y-hidden">
                    <img src="https://i.ytimg.com/vi/RRig5L5edZA/maxresdefault.jpg" class="img-fluid border"
                        style="border-radius: 25px">
                    <!-- <h6 class="text-truncate text-dark fw-bold ps-2 mt-2">Contoh Postingan ke i</h6> -->
                </div>
            </a>
        </section>
    </div>

    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/jquery/jquery.min.js"></script>
    <script>
    var page = 1;
    var isLoading = false;
    var hasMoreData = true;

    document.addEventListener("DOMContentLoaded", function() {
        getData();
    });


    // function getData() {
    //   if (!isLoading && hasMoreData) {
    //     isLoading = true;
    //     $.ajax({
    //       url: '/berandaJsonData?page=' + page,
    //       method: "GET",
    //       beforeSend: function () {
    //         var loadingComponent = "<center id='loading'><div class='spinner-border text-primary' role='status'><span class='visually-hidden'>Loading...</span></div><p>Please Wait...</p></center>";
    //         $("#container-photo").append(loadingComponent);
    //       },
    //       data: {},
    //       success: function (response) {
    //         $("#loading").remove();
    //         if (response.data != '') {
    //           var html = '';

    //           // bikin pengacakan number nya
    //           const randomData = response.data.sort(() => Math.random() - 0.5);

    //           randomData.forEach(function (item) {
    //             html += "<a class='text-decoration-none' href='detail/" + item.id + "'><div class='overflow-y-hidden'><img src='" + item.lokasi_file + "' class='img-fluid border' alt='...' style='border-radius: 25px'><h6 class='text-truncate text-dark fw-bold ps-2'>" + item.deskripsi + "</h6></div></a>";
    //           });

    //           $("#photos").append(html);

    //           isLoading = false;

    //           page++;
    //         }
    //         else {
    //           hasMoreData = false;
    //         }
    //       },
    //       error: function (xhr) {
    //         console.log(xhr);
    //         isLoading = false;
    //       }
    //     });

    //   }
    // }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            getData();
        }
    });
    </script>
    <script>
    var html = '';
    $("#search").on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            method: "GET",
            url: "{{route('searchJSON')}}",
            data: {
                'search': $value
            },
            beforeSend: function() {
                html = '';
            },
            success: function(response) {
                html = response.data;
                $("#searchResult").html(html);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });
    </script>
    <!-- {{--
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script> --}} -->
</body>

</html>
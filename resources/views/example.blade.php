@extends('layouts.default')

@section('content')

    @include('partials.navbar')

    <section class="top-content position-relative bg-dark text-white" style="height:50vh;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center">

                <h1 class="text-center my-5 py-5 fw-bold" style="font-size: 5rem;">
                    My title
                </h1>

                <h4>
                    My subtitle
                </h4>

            </div>
        </div>
    </section>

    <section class="px-5 py-3 bg-secondary bg-opacity-25 fs-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">My subpage</li>
                
            </ol>
        </nav>
    </section>

    <section class="p-5">
        <div class="container py-5 position-relative">

            <div class="btn-group position-absolute top-0 end-0">
                @if(Route::has('posts.create'))
                    @can('posts-create')
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    @endcan
                @endif
            </div>

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque distinctio veritatis maxime laudantium quibusdam eum, incidunt quo vero, sunt inventore perspiciatis et aspernatur, sed laborum placeat est porro molestias corrupti ipsa sit impedit corporis atque? Temporibus maiores velit consectetur excepturi recusandae reprehenderit dolor sit, doloremque porro nulla. Obcaecati, quo? Nulla odit natus assumenda. Facilis maiores voluptates unde molestiae odio omnis a fuga ducimus beatae repudiandae quod quas, odit sit! Eos, nisi! Quas molestiae delectus voluptatem doloremque quod, reiciendis quasi beatae deserunt voluptatum rerum hic dicta, saepe sed? Molestias repudiandae repellat exercitationem maiores, ea modi? Cum, ratione ab saepe alias autem odit pariatur, ipsa expedita ea error natus nihil iusto praesentium minus quia nulla earum repudiandae? Dolorem, quis dolor. Consequuntur officiis dicta sit illum ullam maxime! Voluptatibus voluptas magni facilis enim debitis laboriosam qui laudantium recusandae, sequi ea quasi voluptatem doloremque vitae aperiam fuga earum culpa obcaecati repudiandae sit numquam temporibus. Praesentium, alias dolorem. Cupiditate eos iusto ut libero laborum, suscipit doloribus voluptatem illum quae. Et molestias iusto soluta minus eius vel consequuntur sed blanditiis sint expedita! Debitis voluptatum rem amet quas nam ipsa, unde a dignissimos voluptas distinctio vitae ipsam? Neque in repellendus a laudantium hic fugiat quo dolor, odit suscipit. Ea omnis ut aliquid atque adipisci assumenda expedita soluta harum velit dolorem quo dignissimos, dolor eaque perferendis facere. In deserunt debitis eligendi deleniti similique unde ex illum consequuntur aperiam repellendus hic, esse officiis molestias fuga itaque enim sit sapiente suscipit possimus temporibus iusto provident a minima nemo. Sapiente ullam totam debitis ex aperiam quae quo consequatur voluptates! Quae iusto, non aliquam minus excepturi repellendus iure cumque adipisci possimus maxime officiis eius labore voluptatem in. Praesentium molestiae voluptates quis vitae maiores odio reprehenderit quod ea molestias inventore enim, quia fuga dolores voluptatibus nisi veniam. Aut maxime sequi facere dolores perferendis quis, dolorem fugiat voluptatum iure ipsum illo ea, aliquam asperiores sapiente ipsa veritatis magni necessitatibus at atque excepturi ipsam iusto voluptatibus ducimus. Distinctio aliquid veniam vel aspernatur dolorum ullam delectus ipsam tenetur, et sequi nam qui vitae rem similique aliquam minima quae earum repellat accusamus tempore. Dolores provident magnam hic omnis maxime natus dolor iste tempore quasi et laudantium sit quos, aliquid dolorum illo! Reprehenderit sed eveniet tempore inventore minima, ut deleniti beatae non sapiente saepe accusamus error praesentium quasi ipsum tenetur ab laudantium sit nesciunt temporibus enim quod a dolores. A voluptates qui quo eos animi esse quos enim harum repellat quas distinctio debitis repellendus, iusto vero quod impedit voluptate neque ratione? Ducimus fugit dolor beatae a possimus velit eius quasi et corporis modi nobis debitis quis repellat inventore molestiae, nemo fugiat. Excepturi tempore dolore odio enim, ipsum mollitia? Deserunt ullam vero nihil placeat enim eos voluptate porro, fugiat voluptas ducimus repellendus cum sunt. Doloribus, ullam alias fuga consectetur numquam iste impedit dolore, laborum itaque facere voluptate asperiores officia nihil aliquid excepturi natus odio explicabo molestias pariatur est reprehenderit labore. Voluptatibus sed voluptatem quod laudantium omnis iure, dolores fuga non quos maiores. Quam blanditiis quibusdam delectus, quae vitae dicta?

        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#title').focus();
        });
    </script>
@endsection

@section('styles')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
@endsection
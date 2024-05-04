<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Fahrizal Blog</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="col-md-6 me-auto">
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    </div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap ">
            <a href="/dashboard/carts" class="nav-link px-3 bg-dark border-0 text-white">
                <span data-feather="shopping-cart"></span> Cart
                @php
                    $cartItemCount = \App\Models\Cart::where('deleted', 'no')->count();
                @endphp
                @if ($cartItemCount > 0)
                    <span class="badge badge-pill text-info">{{ $cartItemCount }}</span>
                @endif
            </a>
        </div>
    </div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap ">
            <a href="/orders" class="nav-link px-3 bg-dark border-0 text-white">
                <span data-feather="truck"></span> Delivery Order
                @php
                    $ordersItemCount = \App\Models\Orders::where('status', 'draft')->count();
                @endphp
                @if ($ordersItemCount > 0)
                    <span class="badge badge-pill text-primary">{{ $ordersItemCount }}</span>
                @endif

                @php
                    $ordersItemCount = \App\Models\Orders::where('status', 'needapproval')->count();
                @endphp
                @if ($ordersItemCount > 0)
                    <span class="badge badge-pill text-warning">{{ $ordersItemCount }}</span>
                @endif
            </a>
        </div>
    </div>
    <div class="navbar-nav ">
        <div class="nav-item text-nowrap">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="nav-link px-3 bg-dark border-0">
                    Logout <span data-feather="log-out"></span>
                </button>
            </form>
        </div>
    </div>
</header>

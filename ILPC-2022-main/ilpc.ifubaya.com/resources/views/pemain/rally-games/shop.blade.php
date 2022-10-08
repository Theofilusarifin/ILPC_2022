@extends('pemain.layouts.app', ['pageActive' => 'pemain.shop', 'pageTitle' => 'Shop'])

@section('style')
    <style>
        .select2-selection {
            border-top-right-radius: 0px!important;
            border-bottom-right-radius: 0px!important;
        }
        .btn-weapon {
            border-top-left-radius: 0px!important;
            border-bottom-left-radius: 0px!important;
        }
    </style>
@endsection

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">

            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center" style='background-color: #5c657a'>
                            <h4 class="card-title text-white">PREPARATION PHASE</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text text-center">
                                <h5 class='pt-2'>Sisa Waktu : <span id="hours_left"></span><span id="mins_left"></span><span id="secs_left"></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row match-height">
                <div class="col-lg-6 col-md-6 col-sm-12" style='border-radius: .428rem; max-height: 600px; overflow-y: scroll;background-image: url(https://images.unsplash.com/photo-1466188635785-8b5f35009981?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80);'>
                    <div class="card" style='background: transparent;'>
                        <div class="card-header">
                            <h4 class="card-title text-white">Shop</h4>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex">
                                @foreach ($items as $item)
                                {{-- style='box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);' --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12 p-2" >
                                        <form method="POST" action="{{ route('pemain.buy', $item->name) }}" novalidate>
                                            @csrf
                                            <div class="card" style='box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%)!important;'>
                                                <img style='max-height: 200px; object-fit: cover;' class="card-img-top"
                                                    src="{{ asset('/').$item->image_path }}">
                                                <div class="card-body">

                                                    {{-- Define Variable --}}
                                                    @php($item_type = $item->type)
                                                    @if($item_type == "weapon") 
                                                        @php($color="danger")
                                                        @php($icon = "zap")
                                                    @elseif($item_type == "potion") 
                                                        @php($color="success")
                                                        @php($icon = "heart")
                                                    @elseif($item_type == "attribute") 
                                                        @php($color="warning")
                                                        @php($icon = "pocket")
                                                    @elseif($item_type == "shield") 
                                                        @php($color="info")
                                                        @php($icon = "shield")
                                                    @endif

                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <p class='text-{{ $color }}' style='font-weight: bold;'>{{ $item->name }}</p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <span class='badge badge-light-{{ $color }} rounded-pill'><i data-feather={{ $icon }}></i></span>
                                                        </div>
                                                    </div>

                                                    <div class='p-2' style='box-shadow: inset 0 0px 10px 0 rgb(34 41 47 / 10%); border-radius: .428rem;'>

                                                        @if($item_type == "weapon")
                                                            <p>Attack +{{ $item->attack }} <small class='text-secondary'>(non-stackable)</small></p>
                                                            <p>Durability +{{ $item->durability }} pcs</p>
                                                        @elseif($item_type == "potion")
                                                            <p>Health +{{ $item->heal }} <small class='text-secondary'>(non-stackable)</small></p>
                                                            <p>Durability +{{ $item->durability }} pcs</p>
                                                        @elseif($item_type == "attribute")
                                                            @if(isset($item->heal) && isset($item->attack))
                                                                <p>Max Health +{{ $item->heal }}</p>
                                                                <p>Max Attack +{{ $item->attack }}</p>
                                                            @elseif(isset($item->heal))
                                                                <p>Max Health +{{ $item->heal }}</p>
                                                            @elseif(isset($item->attack))
                                                                <p>Max Attack +{{ $item->attack }}</p>
                                                            @endif
                                                            <small>(non-stackable)</small>
                                                        @elseif($item_type == "shield")
                                                            <p>Blocks any attack once per durability</p>
                                                            <p>Durability +{{ $item->durability }} pcs</p>
                                                        @endif
                                                    </div>
                                                    <hr>

                                                    <button type="submit" class='btn btn-outline-{{ $color }}' style='width: 100%;'>BUY (${{ $item->price }})</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 pe-0">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-primary">Inventory</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 me-4 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="dollar-sign"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$player->current_money}}</h4>
                                            <p class="card-text font-small-3  mb-0">My cash</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 me-4 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-danger avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="zap"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">
                                                {{$player->max_attack}}@isset($selected_weapon)+<span class='text-danger cursor-pointer' data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="{{$selected_weapon->name}} ({{$selected_weapon->pivot->current_durability}} pcs)">{{$selected_weapon->attack}}</span>@endisset
                                            </h4>
                                            <p class="card-text font-small-3  mb-0">Attack</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="heart"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$player->current_health}}/{{$player->max_health}}</h4>
                                            <p class="card-text font-small-3 mb-0">Health</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            @if(is_numeric($player->have_shield))
                            <p>Status Shield : <span class="badge rounded-pill badge-light-success">Active ({{ $player->have_shield }} pcs)</span></p>
                            @else
                            <p>Status Shield : <span class="badge rounded-pill badge-light-danger">Deactive</span></p>
                            @endif

                            <div class="row mb-1">
                            <form method="post" action="{{ route('pemain.changeEquipment') }}">
                                @csrf
                                {{-- Select Weapon --}}
                                <p>Weapon</p>
                                    <div class="row">
                                        {{-- <label class="form-label mb-1" for="regency_id">Weapon</label> --}}
                                        <div class="col-8 pe-0">
                                            <select class="select2 form-select" name='weapon_id' id="add_role">
                                                <option selected disabled>-- Select Weapon Here --</option>
                                                <option value="no" >No Weapon</option>
                                                @foreach ($player_weapons as $weapon)
                                                    <option value="{{ $weapon->id }}" {{ $weapon->pivot->selected == 'yes' ? 'selected' : '' }}>{{ $weapon->name }} ({{ $weapon->pivot->current_durability }} pcs)</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 ps-0">
                                            <button type='submit' class='btn btn-outline-primary btn-weapon'>Change Weapon</button>
                                        </div>
                                    </div>
                            </form>
                            </div>
                            <p>Attribute</p>
                            <div style="max-height:250px; overflow-y: scroll;">
                            <div class="table-resposive">
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th width="50%">Name</th>
                                            <th width="50%">Effect</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$player_attributes->isEmpty())
                                        @foreach($player_attributes as $player_attribute)
                                        <tr>
                                            <td>{{$player_attribute->name}}</td>
                                            @if(isset($player_attribute->heal) && isset($player_attribute->attack))
                                                <td>
                                                    Base Health +{{ $player_attribute->heal }}
                                                    <br>
                                                    Base Attack +{{ $player_attribute->attack }}
                                                </td>
                                            @elseif(isset($player_attribute->heal))
                                                <td>Base Health +{{ $player_attribute->heal }}</td>
                                            @elseif(isset($player_attribute->attack))
                                                <td>Base Attack +{{ $player_attribute->attack }}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan=2>Tidak memiliki attribute</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table> 
                            </div>
                            </div>
                            <br>
                            <br>
                            
                            @include('layouts.alert')

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $('body').bind('copy paste',function(e) {
        alert('This Feature is Disabled');
        e.preventDefault();
        return false; 
    });
    document.addEventListener('contextmenu', event => {
        event.preventDefault()
        alert('This Feature is Disabled');
        return false;
    }); // Klik Kanan
    document.onkeydown = function (e) {
        if(e.keyCode == 123) { alert('This Feature is Disabled'); return false; } // Key F12 -> Menu Application
        if(e.ctrlKey && e.shiftKey && e.keyCode == 73){ alert('This Feature is Disabled'); return false; } // Ctrl Shift i -> Menu Application
        if(e.ctrlKey && e.shiftKey && e.keyCode == 74) { alert('This Feature is Disabled'); return false; } // Ctrl shift j -> Menu Console
        if(e.ctrlKey && e.keyCode == 85) { alert('This Feature is Disabled'); return false; } // Ctrl U -> View Page Source
    }
</script>

<script>
    var year = {{ now()->year }}
    var month = {{ now()->month }}
    var day = {{ now()->day }}
    var hour = {{ now()->hour }}
    var minute = {{ now()->minute }}
    var second = {{ now()->second }}
    var millisecond = {{ now()->millisecond }}

    const countdown = () => {
        let startDate = null;
        var offerDate = new Date({{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->year }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->month }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->day }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->hour }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->minute }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->second }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $shopOpen[0]->jadwal_mulai)->millisecond }});

        second += 1;
        if (second>60){
            minute+=1;
            second-=60;
        }
        if (minute>60){
            hour+=1;
            minute-=60;
        }

        startDate = new Date(year, month, day, hour, minute, second, 0);
        
    
        //offerTime will have the total millseconds
        const offerTime = offerDate - startDate;
        

        // 1 sec= 1000 ms
        // 1 min = 60 sec
        // 1 hour = 60 mins
        const offerHours = Math.floor((offerTime / (1000 * 60 * 60) % 24));
        const offerMins = Math.floor((offerTime / (1000 * 60) % 60));
        const offerSecs = Math.floor((offerTime / 1000) % 60);

        //Kalau waktu sudah habis
        if (offerHours <= 0 && offerMins <= 0 && offerSecs <= 0) {
            window.location = "{{ route('pemain.rally') }}";
        }

        $('#hours_left').html(offerHours+":");
        $('#mins_left').html(offerMins+":");
        $('#secs_left').html(offerSecs);
    }
    setInterval(countdown, 1000);
</script>

@endsection
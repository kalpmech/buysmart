 <!-- Breadcrumb Begin -->
 <div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                    @php
                        $urlPara = explode('/',Request::path());
                    @endphp
                    @isset($urlPara[0])
                        <a href="{{route($urlPara[0])}}">{{ucwords($urlPara[0])}}</a>
                    @endisset
                    <span>{{ isset($urlPara[1]) ? ucwords($urlPara[1]) : '' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

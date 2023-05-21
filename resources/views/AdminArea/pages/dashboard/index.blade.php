@extends('AdminArea.layouts.app')

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper">
        <h1>Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.index')}}">
                        <i class="mdi mdi-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Dashboard
                </li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- New Customers -->
            <div class="card card-table-border-none" data-scroll-height="580">
                <div class="card-header mx-auto">
                    <h2 class="text-center">Welcome to Football-Today Admin Area</h2>
                </div>
                <div class="card-body text-center">
                    <h5>Click <a href="{{route('admin.article.all')}}">here</a> to access the article section</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

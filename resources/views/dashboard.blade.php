@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Total de Empréstimos</h5>
                            <h2 class="card-title">
                                <i class="fa-solid fa-book text-secondary"></i>
                                {{ $totalLoans }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        @include(
                            'components.input',
                            [
                                'type' => 'hidden',
                                'id' => 'array-number-of-loans',
                                'name' => 'array-number-of-loans',
                                'oldValue' => json_encode($arrayNumberOfLoans)
                            ]
                        )
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush

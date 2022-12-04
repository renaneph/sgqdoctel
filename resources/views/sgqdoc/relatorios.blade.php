<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatórios do Sistema') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    
        {!! $chart->container() !!}
        
        <script src="{{ $chart->cdn() }}"></script>

        {{ $chart->script() }}

        {!! $chart2->container() !!}
        
        <script src="{{ $chart2->cdn() }}"></script>

        {{ $chart2->script() }}

        {!! $chart3->container() !!}
        
        <script src="{{ $chart3->cdn() }}"></script>

        {{ $chart3->script() }}
    </div>
</x-app-layout>
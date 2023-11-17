@extends('dashboard.layouts.default')
@section('content')

    <x-panel title="Создание новой области">
        <form method="POST" action="{{ route('hospital.store') }}">
            @csrf
            <table class="table table-striped table-bordered align-middle">
                <tbody>
                <tr>
                    <th>Название больницы</th>
                    <td>
                        <input type="text" name="name" class="form-control" required>
                    </td>
                </tr>
                <tr>
                    <th>Область СОАТО</th>
                    <td>
                        <input type="text" name="region_coato" class="form-control" required>
                    </td>
                </tr>
                <tr>
                    <th>Район СОАТО</th>
                    <td>
                        <input type="text" name="district_coato" class="form-control" required>
                    </td>
                </tr>

                </tbody>
            </table>
            <button type="submit" class="btn btn-primary pull-right ">Создать</button>
        </form>
    </x-panel>
@endsection
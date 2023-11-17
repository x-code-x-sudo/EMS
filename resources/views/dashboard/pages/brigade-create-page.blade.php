@extends('dashboard.layouts.default')
@section('content')

    <x-panel title="Создание новой район">
        <form method="POST" action="{{ route('brigade.store') }}">
            @csrf
            <table class="table table-striped table-bordered align-middle">
                <tbody>
                    <tr>
                        <th>Название бригады</th>
                        <td>
                            <input type="text" name="name" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Номер бригады</th>
                        <td>
                            <input type="number" name="brigade_number" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Выберите подстанции</th>
                        <td>
                            <select class="form-control"  name="substation_id" readonly>
                                @foreach ($substations as $key => $substation)
                                    <option value="{{ $substation->id }}" {{ old('substation_id') == $substation->id ? 'selected' : '' }}>
                                        {{ $substation->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('substation_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>

                </tbody>
            </table>
            <button type="submit" class="btn btn-primary pull-right ">Создать</button>
        </form>
    </x-panel>
@endsection
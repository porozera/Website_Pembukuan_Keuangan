@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Debts'])
    <div class="container-fluid py-4">
        @if(session('success'))
        <div class="alert alert-success" role="alert" id="successMessage">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col d-flex justify-content-between align-items-center">
                                <h6>Debts table</h6>
                                <button class="btn btn-primary btn-sm">
                                    <a href="/debt/add" class="text-white">Add Debts</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            No
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            Amount
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            Interest Rate
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            Due Date
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            Status
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            Description
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $number = 1; @endphp
                                    @foreach ($debt as $item )
                                    <tr>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['amount']}}</p>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['interest_rate']}}</p>
                                        </td>
    
                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['due_date']}}</span>
                                        </td>
    
                                        <td class="align-middle text-center px-3">
                                            @if ($item['status'] == 'Unpaid')
                                                <span class="badge badge-sm bg-gradient-danger">{{$item['status']}}</span>
                                            @elseif ($item['status'] == 'Paid')
                                                <span class="badge badge-sm bg-gradient-success">{{$item['status']}}</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">No Status</span>
                                            @endif
                                            
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['description']}}</p>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <a href="/debt/edit/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form action="/debt/delete/{{ $item['id'] }}" method="POST" style="display:inline;" id="debtDeleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="submitFormButton">Delete</button>
            </div>
        </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
        document.getElementById('submitFormButton').addEventListener('click', function () {
                document.getElementById('debtDeleteForm').submit();
        });
    </script>
@endsection
@extends('layouts.app')
@section('title') Book Device @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/choices.js/choices.min.css">
@endsection
@section('page-js')
    <script src="vendor/choices.js/choices.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="js/validate.js"></script>
@endsection
@section('content')
    <section id="multiple-column-form">
        <form class="form form-booking" method="POST" action="{{ route('book-device.store') }}">
            <div class="row match-height">
                @csrf
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="employee">Employee</label>
                                            <input id="employee" type="text"  class="form-control" placeholder="Employee Name" value="{{ Auth::user()->fullname }}" disabled>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label for="datetimepicker">Intended return date</label>
                                            <input type='date' class="form-control" name="return_intented_date"  id='datetimepicker'/>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="booking-content">Content</label>
                                            <textarea name="content" id="booking-content" class="form-control" rows="6" placeholder="Booking content">{{ old('content') }}</textarea>
                                        </div>
                                    </div>

                                    <h5>Equipment</h5>
                                    <div class="col-md-7 col-6 pe-0">
                                        <div class="form-group">
                                            <select id="equipment" class="form-select choices">
                                                <option value="">Choose equipment</option>
                                                @foreach ($equipments as $equipment)
                                                    <option value="{{ $equipment->id }}">
                                                        {{ $equipment->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-3 px-0">
                                        <div class="form-group">
                                            <input type="number" placeholder="Type Quantity" class="form-control rounded-0"  style="height: 46px;" id="quantity" value="1">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-3 ps-0">
                                        <div class="form-group">
                                            <button class="btn btn-info w-100 rounded-0" style="height: 46px;" onclick="addEquipment()" type="button">Add</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <span class="error text-danger py-0" style="font-size: 17px;" id="error"></span>
                                    </div>

                                    <input type="submit" id="input-submit" class="d-none">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h5>Detail</h5>
                                    <table class="table table-striped" id="table-detail" style="min-height: 270px;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <label for="input-submit" class="btn btn-primary me-1 mb-1">Save</label>
                                    <a href="{{ url()->previous() }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </form>
    </section>

    <script>
        function addEquipment() {
            let selectEquipment = document.getElementById('equipment');
            let inputQuantity = document.getElementById('quantity');
            let error = document.getElementById('error');
            let table = document.getElementById('table-detail');
            let tbody = document.getElementById('tbody');
            let equipment_id = selectEquipment.value;
            let quantity = inputQuantity.value;

            if(equipment_id.trim() == "") {
                error.innerText = "Please select an equipment";
                return;
            }
            if(quantity == 0) {
                error.innerText = "Please type quantity";
                return;
            }
            if(quantity < 0) {
                error.innerText = "Quantity must be greater than 0";
                return;
            }

            fetch(`${ window.location.origin }/equipment-json/${ equipment_id.trim() }`)
            .then(response => response.json())
            .then(data => {
                const { status, message, equipment } = data;

                if(status == "success") {
                    let oldRow = document.getElementById(`row-${equipment.id}`);
                    if(oldRow != null) {
                        let oldQuantity = document.getElementById(`quantity-${equipment.id}`);
                        let oldInputQuantity = document.getElementById(`input-quantity-${ equipment.id }`);
                        let newQuantity = Number(oldQuantity.innerText) + Number(quantity);
                        oldQuantity.innerText = newQuantity;
                        oldInputQuantity.value = newQuantity;
                    }
                    else {
                        let tr = `
                        <tr style="height: 90px;" id="row-${ equipment.id }">
                            <td>${ equipment.name }</td>
                            <td style="width: 100px;">
                                <img class="w-100" src="${ window.location.origin }/images/equipments/${ equipment.image }" alt="">
                            </td>
                            <td id="quantity-${ equipment.id }">${ quantity }</td>
                            <td style="width: 10px;">
                                <a href="javascript:void(0)" onclick="removeEquipment(${ equipment.id })">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <input type="hidden" name="equipment_id[]" value="${ equipment.id }">
                            <input type="hidden" name="quantity[]" value="${ quantity }" id="input-quantity-${ equipment.id }">
                        </tr>
                        `;

                        tbody.innerHTML += tr;
                        table.style.minHeight = "0";
                    }
                }
            })
            
            error.innerText = "";
        }

        function removeEquipment(equipment_id) {
            let deleteRow = document.getElementById(`row-${equipment_id}`);
            let table = document.getElementById('table-detail');

            deleteRow.remove();
            console.log(table);
            console.log(table.rows.length);
            if(table.rows.length == 1) {
                table.style.minHeight = "270px";
            }
        }
    </script>
@endsection
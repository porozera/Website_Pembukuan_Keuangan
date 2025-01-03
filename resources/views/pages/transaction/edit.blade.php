@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Transaksi'])
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Transaksi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="/transaction/edit/{{$transaction['id']}}/perform" enctype="multipart/form-data" id="transactionAddForm">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="date" class="form-control-label">Tanggal</label>
                                            <input class="form-control" type="date" name="date" value="{{$transaction->date}}">
                                            @error('date') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="transaction_typeInput" class="form-control-label">Jenis Transaksi</label>
                                            <select class="form-control" name="transaction_type" id="transaction_type">
                                                <option selected value="{{$transaction->transaction_type}}">{{$transaction->transaction_type}}</option>
                                                <option value="Pemasukan">Pemasukan</option>
                                                <option value="Pengeluaran">Pengeluaran</option>
                                                <option value="Hutang">Hutang</option>
                                                <option value="Piutang">Piutang</option>
                                                <option value="Pemasukan Sebagai Piutang">Pemasukan Sebagai Piutang</option>
                                                <option value="Pengeluaran Sebagai Hutang">Pengeluaran Sebagai Hutang</option>
                                            </select>
                                            @error('transaction_type') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group">
                                            <label id="debitLabel" for="debitInput" class="form-control-label">Simpan ke (Debit)</label>
                                            <select class="form-control" name="debit" id="debit">
                                                <!-- Option akan diisi dinamis melalui JavaScript -->
                                                <option selected value="{{ json_encode(['name' => $transaction->debit_account, 'code' => $transaction->debit_code]) }}">
                                                    {{ $transaction->debit_account }} ({{ $transaction->debit_code }})
                                                </option>
                                            </select>
                                            @error('debit') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group">
                                            <label id="creditLabel" for="creditInput" class="form-control-label">Diterima dari (Kredit)</label>
                                            <select class="form-control" name="credit" id="credit">
                                                <!-- Option akan diisi dinamis melalui JavaScript -->
                                                <option selected value="{{ json_encode(['name' => $transaction->credit_account, 'code' => $transaction->credit_code]) }}">
                                                    {{ $transaction->credit_account }} ({{ $transaction->credit_code }})
                                                </option>
                                            </select>
                                            @error('credit') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="amount" class="form-control-label">Nominal</label>
                                            <input class="form-control" type="number" name="amount" placeholder="Rp. 0" value="{{$transaction->amount}}">
                                            @error('amount') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="due_date" class="form-control-label">Catatan</label>
                                            <textarea class="form-control" type="text" name="description" placeholder="">{{$transaction->description}}</textarea>
                                            @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="interest_rate" class="form-control-label">Bunga (%) (Opsional)</label>
                                            <input class="form-control" type="number" name="interest_rate" placeholder="0%" value="{{$transaction->interest_rate}}">
                                            @error('interest_rate') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="tax" class="form-control-label">Pajak (%) (Opsional)</label>
                                            <input class="form-control" type="number" name="tax" placeholder="0%" value="{{$transaction->tax}}">
                                            @error('tax') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="contact" class="form-control-label">Kontak (Opsional)</label>
                                            <input class="form-control" type="text" name="contact" placeholder="Perusahaan yang terlibat" value="{{$transaction->contact}}">
                                            @error('contact') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="due_date" class="form-control-label">Jatuh Tempo (Opsional)</label>
                                            <input class="form-control" type="date" name="due_date" value="{{$transaction->due_date}}">
                                            @error('due_date') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Kolom kanan -->
                                <div class="col-md-6">
                                    <div class="row-6">
                                        <div class="card shadow-none border h-100">
                                            <div class="card-header border h-100 pb-0">
                                                <p><strong>Total Nominal</strong></p>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Nominal:</strong> <span id="summary-nominal">Rp. 0</span></p>
                                                <p><strong>Bunga:</strong> <span id="summary-bunga">0 %</span></p>
                                                <p><strong>Pajak:</strong> <span id="summary-pajak">0 %</span></p>
                                                <p><strong>Total:</strong> <span id="summary-total">Rp. 0</span></p>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>

                            </div>
                            <!-- Submit Button -->
                            <div class="form-group text-end">
                                <button type="button" class="btn btn-primary btn-sm w-20" data-bs-toggle="modal" data-bs-target="#addModal">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menambah data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitFormButton">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitFormButton').addEventListener('click', function () {
            // Submit the form
            document.getElementById('transactionAddForm').submit();
        });
        document.addEventListener('DOMContentLoaded', function () {
    const accounts = @json($account->groupBy('category'));
    const transactionType = document.getElementById('transaction_type');
    const debitLabel = document.getElementById('debitLabel');
    const creditLabel = document.getElementById('creditLabel');
    const debitInput = document.getElementById('debit');
    const creditInput = document.getElementById('credit');

    const selectedDebitAccount = JSON.stringify({
        name: '{{ $transaction->debit_account }}',
        code: '{{ $transaction->debit_code }}'
    });

    const selectedCreditAccount = JSON.stringify({
        name: '{{ $transaction->credit_account }}',
        code: '{{ $transaction->credit_code }}'
    });

    // Memasukkan akun yang sudah ada ke dalam dropdown saat halaman dimuat
    transactionType.dispatchEvent(new Event('change'));

    // Populasi pilihan berdasarkan jenis transaksi
    populateOptions(debitInput, ['Kas & Bank', 'Persediaan'], selectedDebitAccount);
    populateOptions(creditInput, ['Pendapatan', 'Pendapatan Lainnya'], selectedCreditAccount);

    transactionType.addEventListener('change', function () {
        const selectedType = transactionType.value;

        // Reset debit dan credit options
        debitInput.innerHTML = '<option selected>Pilih Akun</option>';
        creditInput.innerHTML = '<option selected>Pilih Akun</option>';

        if (selectedType === 'Pemasukan') {
            debitLabel.textContent = 'Simpan ke (Debit)';
            creditLabel.textContent = 'Diterima dari (Kredit)';
            populateOptions(debitInput, ['Kas & Bank', 'Persediaan'], selectedDebitAccount);
            populateOptions(creditInput, ['Pendapatan', 'Pendapatan Lainnya'], selectedCreditAccount);

        } else if (selectedType === 'Pengeluaran') {
            debitLabel.textContent = 'Untuk biaya (Debit)';
            creditLabel.textContent = 'Diambil dari (Kredit)';
            populateOptions(debitInput, ['Beban', 'Beban Lainnya', 'Harga Pokok Penjualan', 'Persediaan', 'Kas & Bank', 'Akun Piutan', 'Harta Tetap'], selectedDebitAccount);
            populateOptions(creditInput, ['Kas & Bank', 'Persediaan', 'Harta Lancar Lainnya', 'Harta Tetap', 'Harta Lainnya'], selectedCreditAccount);

        } else if (selectedType === 'Hutang') {
            debitLabel.textContent = 'Simpan ke (Debit)';
            creditLabel.textContent = 'Hutang dari (Kredit)';
            populateOptions(debitInput, ['Kas & Bank', 'Persediaan', 'Harta Lancar Lainnya', 'Harta Tetap', 'Harga Pokok Penjualan', 'Beban', 'Beban Lainnya'], selectedDebitAccount);
            populateOptions(creditInput, ['Akun Hutang', 'Kewajiban Lancar Lainnya', 'Kewajiban Jangka Panjang'], selectedCreditAccount);

        } else if (selectedType === 'Piutang') {
            debitLabel.textContent = 'Simpan ke (Debit)';
            creditLabel.textContent = 'Dari (Kredit)';
            populateOptions(debitInput, ['Akun Piutang'], selectedDebitAccount);
            populateOptions(creditInput, ['Kas & Bank', 'Persediaan', 'Harta Lancar Lainnya', 'Pendapatan', 'Pendapatan Lainnya', 'Modal'], selectedCreditAccount);

        } else if (selectedType === 'Pemasukan Sebagai Piutang') {
            debitLabel.textContent = 'Simpan ke (Debit)';
            creditLabel.textContent = 'Diterima dari (Kredit)';
            populateOptions(debitInput, ['Akun Piutang'], selectedDebitAccount);
            populateOptions(creditInput, ['Pendapatan', 'Pendapatan Lainnya'], selectedCreditAccount);

        } else if (selectedType === 'Pengeluaran Sebagai Hutang') {
            debitLabel.textContent = 'Untuk biaya (Debit)';
            creditLabel.textContent = 'Diambil dari (Kredit)';
            populateOptions(debitInput, ['Harga Pokok Penjualan', 'Beban', 'Beban Lainnya', 'Persediaan', 'Kas & Bank', 'Akun Piutang', 'Harta Tetap'], selectedDebitAccount);
            populateOptions(creditInput, ['Pendapatan', 'Pendapatan Lainnya'], selectedCreditAccount);
        }
    });

    function populateOptions(selectElement, accountTypes, selectedAccount) {
        accountTypes.forEach(type => {
            if (accounts[type]) {
                accounts[type].forEach(account => {
                    const option = document.createElement('option');
                    const accountData = JSON.stringify({ name: account.name, code: account.code });

                    // Memeriksa apakah account yang dipilih sama dengan yang ada di database
                    if (accountData === selectedAccount) {
                        option.selected = true;  // Menambahkan selected jika account yang sama
                    }

                    option.value = accountData;
                    option.textContent = `${account.name} (${account.code})`;
                    selectElement.appendChild(option);
                });
            }
        });
    }

    // Panggilan awal untuk menghitung total
    calculateTotal();
});

// Function to format number to currency
function formatCurrency(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(value);
}

// Event listeners for input changes
const nominalInput = document.querySelector('input[name="amount"]');
const bungaInput = document.querySelector('input[name="interest_rate"]');
const pajakInput = document.querySelector('input[name="tax"]');
const nominalSummary = document.getElementById('summary-nominal');
const bungaSummary = document.getElementById('summary-bunga');
const pajakSummary = document.getElementById('summary-pajak');
const totalSummary = document.getElementById('summary-total');

function calculateTotal() {
    const nominal = parseFloat(nominalInput.value) || 0;
    const bungaPercent = parseFloat(bungaInput.value) || 0;
    const pajakPercent = parseFloat(pajakInput.value) || 0;

    const bunga = nominal * (bungaPercent / 100);
    const pajak = nominal * (pajakPercent / 100);
    const total = nominal + bunga + pajak;

    // Update summaries
    nominalSummary.textContent = formatCurrency(nominal);
    bungaSummary.textContent = `${bungaPercent}% (${formatCurrency(bunga)})`;
    pajakSummary.textContent = `${pajakPercent}% (${formatCurrency(pajak)})`;
    totalSummary.textContent = formatCurrency(total);
}

// Attach event listeners to inputs
nominalInput.addEventListener('input', calculateTotal);
bungaInput.addEventListener('input', calculateTotal);
pajakInput.addEventListener('input', calculateTotal);

</script>
@endsection

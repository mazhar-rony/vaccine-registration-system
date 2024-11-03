@extends('layouts.app')

@section('content')

    <div>
        <div class="bg-white shadow-2xl rounded-lg p-8 max-w-xl w-full mt-20 items-center justify-center m-auto">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Search by NID</h2>
            <form action="#">
                <input type="text" id="nid" name="nid" value="{{ old('nid') }}" placeholder="Enter nid to search..." class="block w-full border border-gray-300 rounded-md shadow-sm p-2 mb-4 focus:outline-none focus:ring focus:ring-gray-500">
                
                <p id="errorMessage" class="text-red-700 p-2"></p>

                <button id="searchBtn" type="submit" class="w-full bg-gray-500 text-white font-bold py-2 rounded-md hover:bg-gray-700 transition duration-200">Search</button>
                
                <div id="result" class="mt-6"></div>
            </form>
        </div>
    </div>

@endsection

@push('css')
    <style>
        .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-left-color: #000;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        animation: spin 0.6s linear infinite;
        display: inline-block;
        vertical-align: middle;
        }
    
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('#searchBtn').on('click', function(e) {
            e.preventDefault();

            $(this).prop('disabled', true).html('<span class="spinner"></span> Loading...');

            const resultsContainer = $('#result');
            resultsContainer.html('');
            $('#errorMessage').html('');
            
            let candidayeNId = $('#nid').val();

            $.ajax({
                url: '{{ route("getCandidate") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nid: candidayeNId
                },
                success: function(response) {
                    if (response != '') {
                        $.each(response, function(i, item) {
                            const resultItem = $('<div></div>');
                            resultItem.addClass('bg-gray-100 p-4 rounded-md shadow mb-4');
                            let date = new Date(item.schedule_date);
                            if (item.status == 'Scheduled') {
                                resultItem.html(`<h3 class="font-bold text-gray-800">${item.name}</h3><p class="font-bold text-green-600">${item.status} on ${date.toLocaleDateString("es-CL")}</p><p class="font-bold text-gray-600">Please check your email for more information.</p>`);
                            } else {
                                resultItem.html(`<h3 class="font-bold text-gray-800">${item.name}</h3><p class="font-bold text-green-600">${item.status}</p>`);
                            }
                            resultsContainer.html(resultItem);
                        });
                    } else {                        
                        const resultItem = $('<div></div>');
                        resultItem.addClass('bg-gray-100 p-4 rounded-md shadow mb-4');
                        resultItem.html(`<h3 class="font-bold text-gray-800">Not registered</h3><a href="{{ route("register.candidate.create") }}" class="text-red-600">Click here to register</a>`);
                        resultsContainer.html(resultItem);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);

                    if (xhr.status === 422) { // validation error
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';

                        $.each(errors, function (key, value) {
                            errorMessages += value[0];
                        });

                        $('#errorMessage').html(errorMessages); // display validation errors
                    }
                },
                complete: function() {
                    // Re-enable button and restore original text
                    $('#searchBtn').prop('disabled', false).html('Search');
                }
            });
        });
    });
</script>
@endpush
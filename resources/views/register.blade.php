@extends('layouts.app')

@section('content')

<div>
    <div class="bg-white shadow-2xl rounded-lg p-8 max-w-xl w-full mt-8 mb-20 items-center justify-center m-auto">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Vaccine Registration Form</h2>
        
        <form action="{{ route('register.candidate.store') }}" method="POST">

            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Full Name<span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-gray-500" placeholder="John Doe">
                @error('name')
                    <p class="text-red-700 p-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email Address<span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-gray-500" placeholder="johndoe@example.com">
                @error('email')
                    <p class="text-red-700 p-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone Number<span class="text-red-500">*</span></label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-gray-500" placeholder="(+88) 01XXXXXXXXX">
                @error('phone')
                    <p class="text-red-700 p-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nid" class="block text-gray-700">NID<span class="text-red-500">*</span><span class="text-sm"> (10 digits)</span></label>
                <input type="text" id="nid" name="nid" value="{{ old('nid') }}" maxlength="10" pattern="[0-9]+" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-gray-500" placeholder="XXXXXXXXXX">
                @error('nid')
                    <p class="text-red-700 p-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="select-center" class="block text-gray-700">Vaccine Center<span class="text-red-500">*</span></label>
                <select id="select-center" name="vaccine_center_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-gray-500">
                    <option value="" disabled selected>Select a vaccine center</option>
                    @foreach ($vaccineCenters as $center)
                        <option value="{{ $center->id }}" {{ old('vaccine_center_id') == $center->id ? 'selected' : '' }}>{{ $center->title }}</option>
                    @endforeach
                </select>
                @error('vaccine_center_id')
                    <p class="text-red-700 p-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-gray-500 text-white font-bold py-2 rounded-md hover:bg-gray-700 transition duration-200">Register</button>
        </form>
    </div>
</div>

@endsection

@push('script')

<script>
    $(document).ready(function() {
        new TomSelect("#select-center",{
            plugins: ['remove_button'],
            onItemAdd:function(){
                this.setTextboxValue('');
                this.refreshOptions();
            },
        });
    });
</script>

@endpush
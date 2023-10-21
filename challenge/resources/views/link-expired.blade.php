<x-guest-layout>
@if(isset($message))
    <div class="bg-green-200 border-l-4 border-green-500 p-4">
        <div class="text-green-700">
            {{ $message }}
        </div>
    </div>
@endif
@if(isset($email))
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <p class="text-2xl font-semibold mb-4">The activation link has expired.</p>
        <p class="mb-4">Please generate a new link to activate your account.</p>
        <a href="{{ route('generate.activation.link', ['email' => $email]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Generate New Link</a>
    </div>
@endif
</x-guest-layout>

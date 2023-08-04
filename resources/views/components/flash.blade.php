@if(session()->has('success'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class=" top-2 bg-laravel text-white px-48 py-3 mx-1/2">
<p>{{session('success')}}</p>
</div>
@endif

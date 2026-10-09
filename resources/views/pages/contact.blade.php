<x-layouts.app>
    <div class="row">
        <h1 class="title">{{ __('misc.contact') }}</h1>
    </div>

    <div class="container">
    @if (session('contact_sent'))
      <div class="alert alert-success" role="status">{{ session('contact_sent') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">{{ __('misc.check_form') }}</div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="name">{{ __('misc.name') }}</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" autocomplete="name" required>
        @error('name') <small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="email">{{ __('misc.email') }}</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required>
        @error('email') <small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="subject">{{ __('misc.subject') }}</label>
        <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject') }}" required>
        @error('subject') <small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="message">{{ __('misc.message') }}</label>
        <textarea id="message" name="message" class="form-control" rows="7" required>{{ old('message') }}</textarea>
        @error('message') <small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <button type="submit" class="btn btn-primary button">{{ __('misc.send_message') }}</button>
    </form>
  </div>
</x-layouts.app>

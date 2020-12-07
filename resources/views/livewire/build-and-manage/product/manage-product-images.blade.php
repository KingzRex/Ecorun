<div x-data="{photos: [], isUploading: false, progress: 0}" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" x-init="@this.on('refresh', () => { photos = [] })">
    <x-jet-form-section submit="saveImages">
        <x-slot name="title">
            {{ __('Product Gallery') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add and remove photos from Product\'s gallery') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-12">
                <div class="text-right mb-4">
                    <x-jet-secondary-button style="color: white;" x-on:click.prevent="$refs.photos.click();" class="bg-blue-900 border border-blue-900">
                        {{ __('add photos') }}
                    </x-jet-secondary-button>
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" wire:model="photos" multiple x-ref="photos" x-on:change="
                        const files = $refs.photos.files;
                        photos = [];
                        for(var i = 0; i < files.length; i++) {
                        photos[i] = {'url': URL.createObjectURL(files[i])}
                        }

                        console.log(files.length);
                    " />

                    <!-- Photos Preview -->
                    <div>
                        <div class="mt-2" x-show.transition="photos.length > 0">
                            <div class="grid @if(count($photos) < 2) grid-cols-1 @else grid-cols-2 @endif sm:grid-cols-4 sm:gap-2 gap-2">
                                <template x-for="photo in photos">
                                    <div x-bind:style="'width: 100%; height: 200px; background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photo.url + '\');'">
                                    </div>
                                </template>
                            </div>

                            <div class="mt-2" x-show.transition="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                    <x-jet-input-error for="photos.*" class="mt-2" />
                </div>

                <div x-show.transtion="photos.length < 1" class="grid col-span-12 @if($product->gallery->count() < 2) grid-cols-1 @else grid-cols-2 @endif sm:grid-cols-4 sm:gap-2 gap-2">
                    @foreach($product->gallery as $image)
                    <div class="">
                        <img class="w-100 h-100" src="/storage/{{$image->image_url}}" />
                        <div class="bg-black py-1 text-right px-1">
                            <x-jet-secondary-button title="delete photo" style="color: white;" class="border border-red-700 bg-red-700" wire:click="deleteImage('{{ $image->id }}')">
                                <i class="fa fa-trash"></i>
                                </x-secondary-jet-button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div x-show.transtion="photos.length > 0">
                <x-jet-action-message class="mr-3" on="added">
                    {{ __('Added.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled">
                    {{ __('Add') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-form-section>
</div>
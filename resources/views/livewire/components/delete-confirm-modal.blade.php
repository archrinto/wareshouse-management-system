<div id="deleteConfirmBackdrop" class="hidden bg-gray-900 bg-opacity-30 absolute top-0 right-0 bottom-0 left-0 z-20">
    <div id="deleteConfirmModal" class="bg-white max-w-md mx-auto mt-36 rounded-md shadow">
        <div class="border-b px-4 py-2 font-semibold">
            {{ __('Delete Confirmation') }}
        </div>
        <div class="px-4 py-4">
            {{ __('Are you sure to delete this item?') }}
        </div>
        <div class="px-4 py-2 flex gap-2 bg-gray-100 rounded-b-md justify-end">
            <button 
                wire:click.prevent="deleteCancel"
                class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                <svg wire:loading wire:target="deleteCancel" aria-hidden="true" role="status" class="w-5 h-5 text-white animate-spin mr-1" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>

                <span>{{ __('Cancel') }}</span>
            </button>
            <button
                wire:click.prevent="deleteConfirm"
                wire:loading.attr="disabled"
                type="button"
                class="bg-red-600 hover:bg-red-500 text-red-200 focus:outline-none font-sm rounded-md text-sm py-2 px-3 text-center items-center shadow-md font-medium"
            >
                <svg wire:loading wire:target="deleteConfirm" aria-hidden="true" role="status" class="w-5 h-5 text-white animate-spin mr-1" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>

                <span>{{ __('Yes, sure!') }}</span>
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            const showDeleteModal = () => {
                document.getElementById('deleteConfirmModal').style.display = "block";
                document.getElementById('deleteConfirmBackdrop').style.display = "block";
            }

            const hideDeleteModal = () => {
                document.getElementById('deleteConfirmModal').style.display = "none";
                document.getElementById('deleteConfirmBackdrop').style.display = "none";
            }

            @this.on('showDeleteConfirmModal', () => {
                console.log('modal shown')
                showDeleteModal()
            });
            @this.on('hideDeleteConfirmModal', () => {
                console.log('modal closed')
                hideDeleteModal()
            });
        });
    </script>    
@endpush
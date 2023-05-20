
    <div class="row mt-5 " style="display: none">
        @isset($jsPath)
            <script>{!! file_get_contents($jsPath) !!}</script>
        @endisset
        @isset($cssPath)
            <style>{!! file_get_contents($cssPath) !!}</style>
        @endisset

        <div class="col-md-6 offset-3">

            <div class="card">

                <div class="card-body">
                    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true close-btn">×</span>

                                    </button>

                                </div>

                                <div class="modal-body">

                                    @forelse($components as $id => $component)
                                        <div x-show.immediate="activeComponent == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                                            @livewire($component['name'], $component['attributes'], key($id))
                                        </div>
                                    @empty
                                    @endforelse

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>

                                    <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

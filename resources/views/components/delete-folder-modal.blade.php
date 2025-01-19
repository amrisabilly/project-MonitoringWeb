@props([
    'modalId',
    'triggerId',
    'triggerText',
    'title',
    'content',
    'class',
    'icon',
    'actions',
    'actionButtonClass',
    'modalIcon',
    'deleteRoute', // Tambahkan route untuk delete
])

<div>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fefefe;
            margin: 10% auto;
            padding: 60px;
            border: 1px solid #888;
            width: 540px;
            height: 350px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 8px;
        }
    </style>

    <button id="{{ $triggerId }}" class="{{ $class }}">
        <img src="{{ $icon }}" alt="" width="24px" style="margin-right: 8px;">
        {{ $triggerText }}
    </button>

    <div id="modal-{{ $modalId }}" class="modal">
        <div class="modal-content">
            <img src="{{ $modalIcon }}" alt="" width="40px">
            <p style="font-size: 25.1px; font-weight:bold; margin:0px;">{{ $title }}</p>
            <p style="margin-bottom:22px; margin-top:0px">{{ $content }}</p>

            <form id="deleteForm" action="{{ $deleteRoute }}" method="POST" style="width: 85%; ">
                @csrf
                @method('DELETE')
                <center>
                    <div class="textfield" style="width: 85%; margin-bottom:2em">
                        <input type="password" id="passwordInput-{{ $modalId }}"
                            placeholder="Input password here" />
                    </div>

                    <p id="errorMessage-{{ $modalId }}" class="error-message" style="display: none;">Your password
                        is
                        incorrect, Please try again</p>
                </center>

                <div style="display: flex; gap:1em; margin-top:2em;">
                    <button type="button" class="secondary-button"
                        style="width:211px;height:29px; justify-content:center"
                        data-modal-id="modal-{{ $modalId }}">Back</button>
                    <button type="button" id="actionButton-{{ $modalId }}" class="{{ $actionButtonClass }}"
                        style="width:211px;height:29px; justify-content:center;color:white">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const trigger = document.getElementById('{{ $triggerId }}');
            const modal = document.getElementById('modal-{{ $modalId }}');
            const closeButton = modal.querySelector('[data-modal-id="modal-{{ $modalId }}"]');
            const actionButton = document.getElementById('actionButton-{{ $modalId }}');
            const passwordInput = document.getElementById('passwordInput-{{ $modalId }}');
            const errorMessage = document.getElementById('errorMessage-{{ $modalId }}');
            const deleteForm = document.getElementById('deleteForm');
            const correctPassword = "sidomuncul-55"; // Password verifikasi

            // Show modal
            trigger.addEventListener('click', () => {
                modal.style.display = 'block';
                passwordInput.value = ''; // Reset input
                errorMessage.style.display = 'none'; // Reset error message
            });

            // Close modal
            closeButton.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            // Action button click handler (verifikasi password dan submit form jika benar)
            actionButton.addEventListener('click', () => {
                if (passwordInput.value === correctPassword) {
                    deleteForm.submit(); // Jika password benar, kirim form delete
                } else {
                    // Jika password salah, tampilkan pesan error
                    errorMessage.style.display = 'block';
                }
            });
        });
    </script>
</div>

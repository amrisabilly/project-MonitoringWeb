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
            margin-top: 10px;
            display: none;
            /* Initially hidden */
        }
    </style>

    <button type="button" id="{{ $triggerId }}" class="{{ $class }}">
        <img src="{{ $icon }}" alt="" width="24px" style="margin-right: 8px;">
        {{ $triggerText }}
    </button>

    <div id="modal-{{ $modalId }}" class="modal">
        <div class="modal-content">
            <img src="{{ $modalIcon }}" alt="" width="40px">
            <p style="font-size: 25.1px; font-weight:bold; margin:0px;">{{ $title }}</p>
            <p style="margin-bottom:22px; margin-top:0px">{{ $content }}</p>
            <div class="textfield" style="width: 85%;">
                <input type="password" id="password-{{ $modalId }}" placeholder="Input password here" />
                </p>
            </div>
            <p id="error-message-{{ $modalId }}" class="error-message">Your password is incorrect, Please try Again
            <div style="display: flex; gap:1em;margin-top:2em">
                <button type="button" class="secondary-button" style="width:211px;height:29px; justify-content:center"
                    data-modal-id="modal-{{ $modalId }}"> Back </button>
                <button id="action-{{ $modalId }}" class="{{ $actionButtonClass }}"
                    style="width:211px;height:29px; justify-content:center; color:white">
                    {{ $triggerText }}
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const trigger = document.getElementById('{{ $triggerId }}');
            const modal = document.getElementById('modal-{{ $modalId }}');
            const closeButton = modal.querySelector('[data-modal-id="modal-{{ $modalId }}"]');
            const passwordInput = document.getElementById('password-{{ $modalId }}');
            const actionButton = document.getElementById('action-{{ $modalId }}');
            const errorMessage = document.getElementById('error-message-{{ $modalId }}');
            const correctPassword = "sidomuncul-55"; // Password verifikasi

            // Buka modal
            trigger.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            // Tutup modal
            closeButton.addEventListener('click', () => {
                modal.style.display = 'none';
                errorMessage.style.display = 'none'; // Sembunyikan error message
                passwordInput.value = ''; // Reset input
            });

            // Aksi tombol action
            actionButton.addEventListener('click', () => {
                if (passwordInput.value === correctPassword) {
                    window.location.href = "{{ $actions }}"; // Redirect ke URL action
                } else {
                    errorMessage.style.display = 'block'; // Tampilkan error message
                }
            });
        });
    </script>
</div>

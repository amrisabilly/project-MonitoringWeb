@props(['modalId', 'triggerId', 'triggerText', 'title', 'content', 'class', 'icon'])

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
            height: 317px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>

    <button id="{{ $triggerId }}" class="{{ $class }}">
        <img src="{{ $icon }}" alt="" width="24px" style="margin-right: 8px;">
        {{ $triggerText }}
    </button>

    <div id="modal-{{ $modalId }}" class="modal">
        <div class="modal-content">
            <img src="img/icons/exclamation-circle.png" alt="" width="40px">
            <p style="font-size: 25.1px; font-weight:bold; margin:0px;">Please Confirm Your Role</p>
            <p style="margin-bottom:22px; margin-top:0px">Please input the password to verify your role to do this
                action</p>
            <div class="textfield" style="width: 85%; margin-bottom:2em">
                <input type="text" placeholder="Input password here" />
            </div>
            <div style="display: flex; gap:1em;">
                <button class="secondary-button" style="width:211px;height:29px; justify-content:center"
                    data-modal-id="modal-{{ $modalId }}"> Back </button>
                <button class="primary-button" style="width:211px;height:29px; justify-content:center"> Verify </button>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const trigger = document.getElementById('{{ $triggerId }}');
            const modal = document.getElementById('modal-{{ $modalId }}');
            const closeButton = modal.querySelector('[data-modal-id="modal-{{ $modalId }}"]');

            trigger.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            closeButton.addEventListener('click', () => {
                modal.style.display = 'none';
            });


        });
    </script>
</div>

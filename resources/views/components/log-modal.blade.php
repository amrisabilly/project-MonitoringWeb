@props(['deviceId', 'deviceName', 'ipAddress', 'macAddress', 'createdAt', 'lastModified'])

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .log-modal-content {
        background-color: #fff;
        padding-block: 20px;
        padding-inline: 80px;
        margin: 5% auto;
        width: 70%;
        border-radius: 15px;
        max-height: 80%;
        overflow-y: auto;
    }

    .close-btn {
        color: #F56E02;
        float: right;
        font-size: 42px;
        cursor: pointer;
    }

    .modal-header-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-bottom: 0px;
    }

    .modal-header-table td table {
        border-collapse: collapse;
        table-layout: fixed;
        color: black;
        display: flex;
        justify-content: stretch;
        flex-direction: column-reverse;
    }

    .modal-header-table td table td {
        padding-block: 6px;
    }

    .time-button button {
        width: 90px;
        height: 43px;
        background-color: transparent;
        border: 1px solid rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .time-button button:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .content-table {
        width: 100%;
        border-collapse: inherit;
        table-layout: fixed;
        padding: 24px;
        margin-bottom: 0px;
        margin-top: 0px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 12px;
    }

    .table-head {
        padding: 8px;
        background-color: #512508;
        color: white
    }
</style>
<div class="modal" id="logModal-{{ $deviceId }}" style="display: none;">
    <div class="log-modal-content">
        {{-- Close Button --}}
        <span class="close-btn">&times;</span>
        {{-- Modal Header --}}
        <table class="modal-header-table">
            <tr>
                {{-- Kolom kiri --}}
                <td>
                    <table>
                        {{-- Baris 1 --}}
                        <tr>
                            <td>
                                Device Name
                            </td>
                            <td style="width:20px;">
                                <center>
                                    :
                                </center>
                            </td>
                            <td>
                                {{ $deviceName }}
                            </td>
                        </tr>
                        {{-- Baris 2 --}}
                        <tr>
                            <td>
                                IP Address
                            </td>
                            <td style="width:20px;">
                                <center>

                                    :
                                </center>
                            </td>
                            <td>
                                {{ $ipAddress }}
                            </td>
                        </tr>
                        {{-- Baris 3 --}}
                        <tr>
                            <td>
                                MAC Address
                            </td>
                            <td style="width:20px;">
                                <center>

                                    :
                                </center>
                            </td>
                            <td>
                                {{ $macAddress }}
                            </td>
                        </tr>
                    </table>
                </td>
                {{-- Kolom Tengah --}}
                <td>
                    <table>
                        {{-- Baris 1 --}}
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        {{-- Baris 2 --}}
                        <tr>
                            <td>
                                Created at
                            </td>
                            <td style="width:20px;">
                                <center>

                                    :
                                </center>
                            </td>
                            <td>
                                {{ $createdAt }}
                            </td>
                        </tr>
                        {{-- Baris 3 --}}
                        <tr>
                            <td>
                                Last modified
                            </td>
                            <td style="width:20px;">
                                <center>

                                    :
                                </center>
                            </td>
                            <td>
                                {{ $lastModified }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <hr style="border: 1px solid black;">

        {{-- Title --}}
        <div style="display: flex; justify-content:space-between;align-items:center">
            <div>
                <p style="font-size: 22px; font-weight:bold; margin-bottom:0px">Device's Record</p>
                <p style="margin-top:0px">See summary result from this device</p>
            </div>
            <div style="display: flex; justify-items:stretch" class="time-button">
                <button style="border-radius: 5px 0px 0px 5px ">
                    7 days
                </button>
                <button>
                    Month
                </button>
                <button style="border-radius: 0px 5px 5px 0px ">
                    Year
                </button>
            </div>
        </div>

        {{-- Log Device Status & Stats Summary --}}
        <table class="content-table">
            <tr>
                {{-- Log Device Status --}}
                <td style="width:652px; border-right:1px solid rgba(0, 0, 0, 0.3);">
                    <center>
                        <p><strong>Log Device Status</strong></p>
                        <div
                            style="border-radius: 12px; overflow: hidden; border: 1px solid rgba(0, 0, 0, 0.3); width:90%;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead class="table-head">
                                    <tr>
                                        <td>Event Time</td>
                                        <td>
                                            <center>Status</center>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="padding: 8px">
                                        <td>08/01/2025, 12:07:59</td>
                                        <td>
                                            <center>online</center>
                                        </td>
                                    </tr>
                                    <tr style="padding: 8px">
                                        <td>08/01/2025, 12:07:57</td>
                                        <td>
                                            <center>offline</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </center>
                </td>
                {{-- Stats Summary --}}
                <td style="padding-left: 24px;">
                    <center>
                        <p><strong>Stats Summary</strong></p>
                    </center>
                    {{-- online --}}
                    <div style="display: flex; margin-bottom:1em">
                        <div
                            style="width:64px;  color:white;border-radius:5px;background-color: #34C759; display:flex;align-items:center; justify-content:center">
                            50%
                        </div>
                        <div style="height 44px; margin-left:1em;">
                            <div><strong> 1 Times </strong></div>
                            <div>Online result</div>
                        </div>
                    </div>
                    {{-- offline --}}
                    <div style="display: flex;">
                        <div
                            style="width:64px;  color:white;border-radius:5px;background-color: #CB0B00; display:flex;align-items:center; justify-content:center">
                            50%
                        </div>
                        <div style="height 44px; margin-left:1em;">
                            <div><strong> 1 Times </strong></div>
                            <div>Offline result</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>



    </div>
</div>

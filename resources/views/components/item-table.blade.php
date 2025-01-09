<div>
    <style>
        .main-table {
            width: 100%;
            margin: 0;
            padding: 0px;
            margin-bottom: 1em;
            border-collapse: collapse;
            height: 315px;
        }

        .header {
            font-weight: 300;
            color: white;
            padding: 24px;
            background-color: #25160f;
        }

        .items-row {
            height: 60px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            transition: background-color 0.2s ease, transform 0.3s ease;
        }

        .items-row:hover {
            background-color: rgba(0, 0, 0, 0.115);
        }


        .status-online {
            background-color: #34c7590e;
            border: 1px solid #34c759;
            color: #34c759;
            width: max-content;
            padding-inline: 20px;
            padding-top: 2px;
            padding-bottom: 2px;
            border-radius: 15px;
        }

        .status-offline {
            background-color: #ff3b300e;
            border: 1px solid #ff3b30;
            color: #ff3b30;
            width: max-content;
            padding-inline: 20px;
            padding-top: 2px;
            padding-bottom: 2px;
            border-radius: 15px;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        /* Scrollbar styling */
        table::-webkit-scrollbar {
            width: 10px;
        }

        table::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.134);
            border-radius: 5px;
        }

        table::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        table::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .inactive-row {
            color: rgba(0, 0, 0, 0.5)
        }
    </style>

    {{-- Main Table --}}
    <table class="main-table" id="itemTable">
        {{-- Header --}}
        <thead>
            <tr>
                <td style="text-align: center; border-top-left-radius:10px;" class="header">
                </td>
                <td class="header" style="padding-left: 0">
                    Device Name
                </td>
                <td class="header" style="text-align: center">
                    IP Address
                </td>
                <td class="header" style="text-align: center">
                    Status
                </td>
                <td class="header" style="text-align: center">
                    MAC Address
                </td>
                <td class="header" style="text-align: center; border-top-right-radius:10px;">
                    Disable/Enable
                </td>
            </tr>
        </thead>
        <tbody>
            {{-- Items Online --}}
            <tr class="items-row">
                <td style="text-align: center">
                    <input type="checkbox" class="checkBox" name="" id="">
                </td>
                <td>
                    <div>

                        <p style="max-width: 287px; word-wrap:break-word; ">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus.
                        </p>
                    </div>
                </td>
                <td style="text-align: center">
                    <p>255.255.255.255</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <p class="status-online">
                            online
                        </p>
                    </center>
                </td>
                <td style="text-align: center">
                    <p>xx:xx:xx:xx:xx:xx</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <x-toggle id="toggle1" :isActive="true" />
                    </center>
                </td>
            </tr>
            {{-- Items Online --}}
            <tr class="items-row">
                <td style="text-align: center">
                    <input type="checkbox" class="checkBox" name="" id="">
                </td>
                <td>
                    <div>

                        <p style="max-width: 287px; word-wrap:break-word; ">
                            Aorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus.
                        </p>
                    </div>
                </td>
                <td style="text-align: center">
                    <p>255.255.255.255</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <p class="status-online">
                            online
                        </p>
                    </center>
                </td>
                <td style="text-align: center">
                    <p>xx:xx:xx:xx:xx:xx</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <x-toggle id="toggle2" :isActive="true" />
                    </center>
                </td>
            </tr>
            {{-- Items Online --}}
            <tr class="items-row">
                <td style="text-align: center">
                    <input type="checkbox" class="checkBox" name="" id="">
                </td>
                <td>
                    <div>

                        <p style="max-width: 287px; word-wrap:break-word; ">
                            Torem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus.
                        </p>
                    </div>
                </td>
                <td style="text-align: center">
                    <p>255.255.255.255</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <p class="status-online">
                            online
                        </p>
                    </center>
                </td>
                <td style="text-align: center">
                    <p>xx:xx:xx:xx:xx:xx</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <x-toggle id="toggle3" :isActive="true" />
                    </center>
                </td>
            </tr>
            {{-- Items Online --}}
            <tr class="items-row">
                <td style="text-align: center">
                    <input type="checkbox" class="checkBox" name="" id="">
                </td>
                <td>
                    <div>

                        <p style="max-width: 287px; word-wrap:break-word; ">
                            Corem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus.
                        </p>
                    </div>
                </td>
                <td style="text-align: center">
                    <p>255.255.255.255</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <p class="status-online">
                            online
                        </p>
                    </center>
                </td>
                <td style="text-align: center">
                    <p>xx:xx:xx:xx:xx:xx</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <x-toggle id="toggle4" :isActive="true" />
                    </center>
                </td>
            </tr>
            {{-- Items Offline --}}
            <tr class="items-row">
                <td style="text-align: center">
                    <input type="checkbox" class="checkBox" name="" id="">
                </td>
                <td>
                    <div>

                        <p style="max-width: 287px; word-wrap:break-word; ">
                            Borem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus.
                        </p>
                    </div>
                </td>

                <td style="text-align: center">
                    <p>255.255.255.255</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <p class="status-offline">
                            Offline
                        </p>
                    </center>
                </td>
                <td style="text-align: center">
                    <p>xx:xx:xx:xx:xx:xx</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <x-toggle id="toggle5" :isActive="false" />
                    </center>
                </td>

            </tr>
            {{-- Items Offline --}}
            <tr class="items-row">
                <td style="text-align: center">
                    <input type="checkbox" class="checkBox" name="" id="">
                </td>
                <td>
                    <div>

                        <p style="max-width: 287px; word-wrap:break-word; ">
                            Dorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus.
                        </p>
                    </div>
                </td>

                <td style="text-align: center">
                    <p>255.255.255.255</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <p class="status-offline">
                            Offline
                        </p>
                    </center>
                </td>
                <td style="text-align: center">
                    <p>xx:xx:xx:xx:xx:xx</p>
                </td>
                <td style="text-align: center">
                    <center>
                        <x-toggle id="toggle6" :isActive="false" />
                    </center>
                </td>

            </tr>

        </tbody>

    </table>

    <script>
        function staticToggle(element) {
            element.classList.toggle('active'); // Toggle status aktif

            // Temukan parent row dari toggle
            var row = element.closest('.items-row');

            // Tambah atau hapus kelas inactive-row
            if (!element.classList.contains('active')) {
                row.classList.add('inactive-row');
            } else {
                row.classList.remove('inactive-row');
            }
        }

        // Inisialisasi: Set opacity pada semua row dengan toggle tidak aktif
        document.querySelectorAll('.toggle').forEach(function(toggle) {
            var row = toggle.closest('.items-row');
            if (!toggle.classList.contains('active')) {
                row.classList.add('inactive-row');
            }
        });
    </script>

</div>

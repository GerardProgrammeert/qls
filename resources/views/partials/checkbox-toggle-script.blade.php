@push('scripts')
    <script>
        function toggleSection() {
            const isSame = document.getElementById('is_same');
            const receiverSection = document.getElementById('receiverSection');
            const inputFields = receiverSection.querySelectorAll('input');

            if (isSame.checked) {
                receiverSection.style.display = 'none';
                document.getElementById("is_same_hidden").value = true;
                inputFields.forEach(input => {
                    input.dataset.wasRequired = input.required;
                    input.required = false;
                    input.disabled = true;
                });
            } else {
                receiverSection.style.display = 'block';
                document.getElementById("is_same_hidden").value = false;
                inputFields.forEach(input => {
                    input.disabled = false;

                    if (input.dataset.wasRequired === "true") {
                        input.required = true;
                    }
                });
            }
        }
        document.getElementById('is_same').addEventListener('change', toggleSection);

        window.addEventListener('DOMContentLoaded', () => {
            toggleSection();
        });
    </script>
@endpush

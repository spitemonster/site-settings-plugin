//
window.addEventListener('DOMContentLoaded', () => {
    const mediaSelectButtons = document.querySelectorAll('.media-upload')
    let mediaUploader

    mediaSelectButtons.forEach((b) => {
        b.addEventListener('click', (e) => {
            e.preventDefault()

            const inputName = e.target.dataset.inputName
            const input = document.querySelector(`input[name="${inputName}"]`)

            if (!mediaUploader) {
                mediaUploader = wp.media({
                    title: 'Select Fallback Image',
                    button: {
                        text: 'Select',
                    },
                    multiple: false,
                })

                mediaUploader.on('select', () => {
                    let attachment = mediaUploader
                        .state()
                        .get('selection')
                        .first()
                        .toJSON()

                    input.value = attachment.url
                })
            }

            mediaUploader.open()
        })
    })
})

import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Image from '@tiptap/extension-image'
import Link from '@tiptap/extension-link'


window.initEditor = (elementId, hiddenInputId) => {
    const editor = new Editor({
        element: document.querySelector(`#${elementId}`),
        extensions: [
            StarterKit,
            Image,
            Link,
        ],
        content: '<p>Начни писать...</p>',

        onUpdate({ editor }) {
            document.querySelector(`#${hiddenInputId}`).value = editor.getHTML()
        },
    })

    return editor
}

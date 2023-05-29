<template>
    <div class="mt-2">
        <div class="flex flex-wrap">
            <button @click.submit.prevent="applyBold" class="button">
                B   
            </button>
            <button @click.submit.prevent="applyItalic" class="button">
                I
            </button>
            <button @click.submit.prevent="applyHeading" class="button">
                H
            </button>
            <button @click.submit.prevent="applyUl" class="button">
                UL
            </button>
            <button @click.submit.prevent="applyOl" class="button">
                OL
            </button>
        </div>
        <div
            @input="onInput"
            v-html="innerValue"
            contenteditable="true"
            class="wysiwyg-output block bg-white p-2 outline-none border-gray-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 rounded-md shadow-sm"
        />
    </div>
</template>
<script>
export default {
  name: 'Wysiwyg',

  props: ['value'],

  data() {
    return {
      innerValue: this.value || '<p><br></p>'
    }
  },

  methods: {
    onInput(event) {
      this.$emit('update:value', event.target.innerHTML)
    },
    applyBold() {
        document.execCommand('bold')
    },
    applyItalic() {
        document.execCommand('italic')
    },
    applyHeading() {
        document.execCommand('formatBlock', false, '<h3>')
    },
    applyUl() {
        document.execCommand('insertUnorderedList')
    },
    applyOl() {
        document.execCommand('insertOrderedList')
    },
  },

  mounted() {
    document.execCommand('defaultParagraphSeparator', false, 'p')
  },
}
</script>

<style>
.button {
  @apply border-2;
  @apply border-gray-300;
  @apply rounded-lg;
  @apply px-3 py-1;
  @apply mb-3 mr-3;
  @apply bg-white;
}
.button:hover {
  @apply border-emerald-300;
}
.wysiwyg-output p {
  @apply pb-4;
}
.wysiwyg-output ul {
  @apply ml-6;
  @apply list-disc;
}
.wysiwyg-output ol {
  @apply ml-6;
  @apply list-decimal;
}
.wysiwyg-output h3 {
  @apply text-xl;
  @apply font-bold;
  @apply pb-1;
}
</style>
<template>
    <div class="input-group">
        <div class="custom-file">
            <input
                type="file"
                class="custom-file-input"
                id="fileInput01"
                name="csvFile"
                @change="displayFileName"
            />
            <label class="custom-file-label" for="fileInput01">
                <span v-if="!files || !files.length">Selecione um arquivo</span>
                <span v-else>{{ files[0].name }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'upload-form',
    data() {
        return {
            files: null
        };
    },
    methods: {
        displayFileName(e) {
            this.files = e.target.files;
        }
    }
};
</script>

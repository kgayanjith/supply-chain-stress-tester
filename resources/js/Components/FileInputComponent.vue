<template>
  <div>
    <!-- Single preview (isMultiple = false) -->
    <div v-if="!isMultiple" :id="id + 'ImagePreview'" :class="'image-preview-box ' + parentCls"
      :style="{ backgroundImage: `url('${previewSrc}')` }" @click="openFile"></div>

    <!-- Multiple previews (isMultiple = true) -->
    <div v-else style="display: flex; flex-wrap: wrap; gap: 8px;">
      <div v-for="(src, index) in multiplePreviews" :key="index" style="position: relative; display: inline-block;">
        <div :class="'image-preview-box ' + parentCls" :style="{ backgroundImage: `url('${src}')` }"></div>
        <span @click="removeImage(index)" style="position: absolute; top: -6px; right: -6px; background: red; color: white;
             border-radius: 50%; width: 18px; height: 18px; text-align: center;
             line-height: 18px; font-size: 12px; cursor: pointer;">&times;</span>
      </div>

      <!-- Add more button -->
      <div :class="'image-preview-box ' + parentCls"
        :style="{ backgroundImage: `url('${prvImage || '/images/file-upload.png'}')` }" @click="openFile"></div>
    </div>

    <input ref="file" type="file" :id="id" class="form-control" style="display: none !important"
      @change="handleFileChange" :multiple="isMultiple" :required="isRequired" accept="image/*" />
  </div>
</template>

<script>
export default {
  props: {
    id: { type: String, required: true },
    prvImage: { type: String, default: "" },
    isMultiple: { type: Boolean, default: false },
    parentCls: { type: String, default: "" },
    modelValue: { default: null },
    isRequired: { type: Boolean, default: true },
  },
  data() {
    return {
      localPreview: "",         // single mode preview
      multiplePreviews: [],     // multiple mode previews
      allFiles: [],             // accumulated files for multiple mode
    };
  },
  computed: {
    previewSrc() {
      return this.localPreview || this.prvImage || "/images/file-upload.png";
    },
  },
  methods: {
    openFile() {
      this.$refs.file.click();
    },
    handleFileChange(e) {
      const files = e.target.files;
      if (!files || files.length === 0) return;

      if (!this.isMultiple) {
        // --- Single mode (unchanged) ---
        const file = files[0];
        this.$emit("update:modelValue", file);

        const reader = new FileReader();
        reader.onload = () => {
          this.localPreview = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        // --- Multiple mode ---
        const newFiles = Array.from(files);

        // Accumulate files
        this.allFiles = [...this.allFiles, ...newFiles];
        this.$emit("update:modelValue", this.allFiles);

        // Generate previews for newly added files
        newFiles.forEach((file) => {
          const reader = new FileReader();
          reader.onload = () => {
            this.multiplePreviews.push(reader.result);
          };
          reader.readAsDataURL(file);
        });
      }

      // Allow selecting same file again
      e.target.value = "";
    },
    removeImage(index) {
      this.multiplePreviews.splice(index, 1);
      this.allFiles.splice(index, 1);
      this.$emit("update:modelValue", this.allFiles);
    },
  },
};
</script>

<style>
.image-preview-box {
  width: 80px;
  height: 80px;
  cursor: pointer;
  border: 2px dashed #d3d3d3;
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
  display: inline-block;
  z-index: 99999;
}
</style>
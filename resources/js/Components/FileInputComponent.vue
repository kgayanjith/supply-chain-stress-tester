<template>
  <div>
    <div
      :id="id + 'ImagePreview'"
      :class="'image-preview-box ' + parentCls"
      :style="{ backgroundImage: `url(${previewSrc})` }"
      @click="openFile"
    ></div>

    <input
      ref="file"
      type="file"
      :id="id"
      class="form-control"
      style="display: none !important"
      @change="handleFileChange"
      :multiple="isMultiple"
      :required="isRequired"
      accept="image/*"
    />
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
      localPreview: "", // ✅ new selected preview (base64)
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
      const file = this.isMultiple ? files : (files[0] || null);

      // emit file(s)
      this.$emit("update:modelValue", file);

      // preview (only first file)
      const first = files && files[0] ? files[0] : null;
      if (!first) return;

      const reader = new FileReader();
      reader.onload = () => {
        this.localPreview = reader.result; // ✅ replaces old preview
      };
      reader.readAsDataURL(first);

      // allow selecting same file again
      e.target.value = "";
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
}
</style>
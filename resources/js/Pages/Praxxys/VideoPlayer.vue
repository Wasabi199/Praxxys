<template>
  <Sidebar>
    <div class=" overflow-y-hidden">
      <video-player :options="videoOptions" />
    </div>
  </Sidebar>
</template>
<script setup lang="ts">
import VideoPlayer from './Partials/Video/Video.vue';
import Sidebar from './Partials/Sidebar.vue';
import { reactive } from 'vue';

const videoOptions = reactive({
  autoplay: true,
  controls: true,
  sources: [
    {
      src:
        'videos/sample.mp4',
      type: 'video/mp4'
    }
  ]

});
</script>
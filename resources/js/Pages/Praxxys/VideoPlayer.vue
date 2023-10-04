<template>
    <Sidebar>
        <div class=" overflow-y-hidden">
          <video-player  :options="videoOptions"  />
        </div>
    </Sidebar>
  </template>
  
  <script>
  import VideoPlayer from './Partials/Video/Video.vue';
  import Sidebar from './Partials/Sidebar.vue';
  
  export default {
    name: 'VideoExample',
    components: {
      VideoPlayer,
      Sidebar
    },
    data() {
      return {
        videoOptions: {
          autoplay: true,
          controls: true,
          sources: [
            {
              src:
                'videos/sample.mp4',
                type: 'video/mp4'
            }
          ]
        }
      };
    }
  };
  </script>
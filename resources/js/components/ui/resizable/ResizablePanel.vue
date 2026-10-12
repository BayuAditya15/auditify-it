<script setup lang="ts">
import type { SplitterPanelProps } from "reka-ui"
import { SplitterPanel, useForwardProps } from "reka-ui"

const props = defineProps<SplitterPanelProps>()
const forwarded = useForwardProps(props)
</script>

<template>
  <SplitterPanel
    data-slot="resizable-panel"
    v-bind="forwarded"
  >
    <slot />
  </SplitterPanel>
</template>

<script setup lang="ts">
import type { ScrollAreaRootProps } from "reka-ui"
import type { HTMLAttributes } from "vue"
import { reactiveOmit } from "@vueuse/core"
import {
  ScrollAreaCorner,
  ScrollAreaRoot,
  ScrollAreaViewport,
} from "reka-ui"
import { computed } from "vue"
import { cn } from "@/lib/utils"
import ScrollBar from "./ScrollBar.vue"

const props = withDefaults(
  defineProps<ScrollAreaRootProps & { class?: HTMLAttributes["class"] }>(),
  {
    type: "hover",
  },
)

const delegatedProps = reactiveOmit(props, "class")
const forwarded = computed(() => delegatedProps)
</script>

<template>
  <ScrollAreaRoot
    data-slot="scroll-area"
    v-bind="forwarded"
    :class="cn('relative overflow-hidden', props.class)"
  >
    <ScrollAreaViewport
      data-slot="scroll-area-viewport"
      class="ring-ring/50 h-full w-full rounded-[inherit] transition-[color,box-shadow] focus-visible:ring-4 focus-visible:outline-hidden"
    >
      <slot />
    </ScrollAreaViewport>
    <ScrollBar />
    <ScrollAreaCorner />
  </ScrollAreaRoot>
</template>

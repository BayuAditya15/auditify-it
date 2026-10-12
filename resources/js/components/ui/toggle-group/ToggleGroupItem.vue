<script setup lang="ts">
import type { ToggleGroupItemProps } from "reka-ui"
import type { HTMLAttributes } from "vue"
import type { ToggleGroupVariants } from "."
import { reactiveOmit } from "@vueuse/core"
import { ToggleGroupItem, useForwardProps } from "reka-ui"
import { inject } from "vue"
import { cn } from "@/lib/utils"
import { toggleGroupVariants } from "."

const props = defineProps<ToggleGroupItemProps & {
  class?: HTMLAttributes["class"]
  variant?: ToggleGroupVariants["variant"]
  size?: ToggleGroupVariants["size"]
}>()

const context = inject<ToggleGroupVariants>("toggleGroup", {})

const delegatedProps = reactiveOmit(props, "class", "variant", "size")
const forwardedProps = useForwardProps(delegatedProps)
</script>

<template>
  <ToggleGroupItem
    data-slot="toggle-group-item"
    v-bind="forwardedProps"
    :class="cn(toggleGroupVariants({
      variant: props.variant ?? context.variant,
      size: props.size ?? context.size,
    }), props.class)"
  >
    <slot />
  </ToggleGroupItem>
</template>

# Contributing

Contribution guidelines are centralized for the whole Ichava org:

- [Code of Conduct](CODE_OF_CONDUCT.md)

For this pack specifically: icon assets are refreshed from upstream by the
[icon-sets-sync](https://opensource.simtabi.com/documentation/ichava/icon-sets-sync/maintainer-sync).
Please do not hand-edit generated SVGs; contribute fixes to the sync recipe
or the upstream source instead.

## Releases and versioning

- **A version tag is pushed only for final code.** `vX.Y.Z` marks a release, nothing else. To try a
  release build first, push a pre-release tag, `vX.Y.Z-rc.N`: it is cached like any other tag, but it
  uses up no release number.
- **A public tag is never moved, deleted or reused.** The first time anything fetches a tag, its
  contents are cached for good: by the Go module proxy and `sum.golang.org` for any public GitHub
  tag, by Packagist for a Composer package, and by npm and every consumer pinning a git tag for a
  JavaScript one. Moving the tag afterwards does not change what those serve; it only makes them
  disagree with git. The next fix gets the next number.
- **A tag ruleset enforces this.** Applied once the v0.1.0 tags are pushed, it blocks deleting,
  updating and force-pushing `v*` tags on this repository. The v0.1.0 publication as a
  single commit was the one planned exception.
- **A bad release is retracted, not replaced.** Name it in the CHANGELOG and the GitHub release notes, and leave it listed on Packagist, which has no per-version retraction (only a whole package can be marked abandoned). Then ship the fix as the next
  version.

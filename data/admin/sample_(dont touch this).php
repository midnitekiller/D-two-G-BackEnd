<style>
#modal-container {
  position: fixed;
  display: table;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  transform: scale(0);
  z-index: 1;
}

#modal-container.five {
  transform: scale(1);
}
#modal-container.five .modal-background {
  background: transparent;
  animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal-container.five .modal-background .modal {
  transform: translateX(-1500px);
  animation: roadRunnerIn 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal-container.five.out {
  animation: quickScaleDown 0s .5s linear forwards;
}
#modal-container.five.out .modal-background {
  animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal-container.five.out .modal-background .modal {
  animation: roadRunnerOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}


#modal-container .modal-background {
  display: table-cell;
  background: rgba(0, 0, 0, 0.8);
  text-align: center;
  vertical-align: middle;
}
#modal-container .modal-background .modal {
  background: white;
  padding: 50px;
  display: inline-block;
  border-radius: 3px;
  font-weight: 300;
  position: relative;
}
#modal-container .modal-background .modal h2 {
  font-size: 25px;
  line-height: 25px;
  margin-bottom: 15px;
}
#modal-container .modal-background .modal p {
  font-size: 18px;
  line-height: 22px;
}
#modal-container .modal-background .modal .modal-svg {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  border-radius: 3px;
}
#modal-container .modal-background .modal .modal-svg rect {
  stroke: #fff;
  stroke-width: 2px;
  stroke-dasharray: 778;
  stroke-dashoffset: 778;
}



@keyframes fadeIn {
  0% {
    background: transparent;
  }
  100% {
    background: rgba(0, 0, 0, 0.7);
  }
}
@keyframes fadeOut {
  0% {
    background: rgba(0, 0, 0, 0.7);
  }
  100% {
    background: transparent;
  }
}

@keyframes roadRunnerIn {
  0% {
    transform: translateX(-1500px) skewX(30deg) scaleX(1.3);
  }
  70% {
    transform: translateX(30px) skewX(0deg) scaleX(0.9);
  }
  100% {
    transform: translateX(0px) skewX(0deg) scaleX(1);
  }
}
@keyframes roadRunnerOut {
  0% {
    transform: translateX(0px) skewX(0deg) scaleX(1);
  }
  30% {
    transform: translateX(-30px) skewX(-5deg) scaleX(0.9);
  }
  100% {
    transform: translateX(1500px) skewX(30deg) scaleX(1.3);
  }
}

@keyframes modalFadeIn {
  0% {
    background-color: transparent;
  }
  100% {
    background-color: white;
  }
}
@keyframes modalFadeOut {
  0% {
    background-color: white;
  }
  100% {
    background-color: transparent;
  }
}
@keyframes modalContentFadeIn {
  0% {
    opacity: 0;
    top: -20px;
  }
  100% {
    opacity: 1;
    top: 0;
  }
}
@keyframes modalContentFadeOut {
  0% {
    opacity: 1;
    top: 0px;
  }
  100% {
    opacity: 0;
    top: -20px;
  }
}

</style>
<div id="modal-container">
  <div class="modal-background">
    <div class="modal">
      <h2>Successfully Added</h2>
    </div>
  </div>
</div>
<div class="content">
  <div class="buttons">
    <div id="five" class="button">Meep Meep</div>
  </div>
</div>
<script>
    $('.button').click(function(){
  var buttonId = $(this).attr('id');
  $('#modal-container').removeAttr('class').addClass(buttonId);
  $('body').addClass('modal-active');
})

$('#modal-container').click(function(){
  $(this).addClass('out');
  $('body').removeClass('modal-active');
});
</script>  
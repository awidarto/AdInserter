<h2><?php print  $this->bep_assets->icon('titles/64/update-campaign');?></h2>
<script type='text/javascript'>
	var eventObjects = [];
	jQuery(document).ready(function() {
		
		$( "#cpn_start,#cpn_end" ).datepicker({
			showWeek: true,
			firstDay: 1,
			dateFormat: 'yy-mm-dd'
		});

		$("#cpn_time_start,#cpn_time_end").timepicker({});
		
	
	
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		jQuery('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()), // use the element's text as the event title
				cpn_id: $.trim($(this).attr('ref'))
			};
			
			// store the Event Object in the DOM element so we can get to it later
			jQuery(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			jQuery(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});
	
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		
		jQuery('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,agendaDay'
				},
				currentTimezone: 'Asia/Jakarta',
				editable: true,
				droppable: true, // this allows things to be dropped onto the calendar !!!
				drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
	
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
	
				// assign it the date that was reported
				date.setHours(7);
				copiedEventObject.start = date;
				copiedEventObject.allDay = false;
	
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				jQuery('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
	
				setEventForm(copiedEventObject);
	
				// is the "remove after drop" checkbox checked?
				//jQuery('#external-events').remove();
	
				//jQuery('#calendar').fullCalendar('gotoDate',$.fullCalendar.parseISO8601( event.start ));                    
	
			},
			events: '<?php print site_url('ad/adevent/'.$this->session->userdata('id'))?>',
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
    
             //setEventForm(event);
         },
         eventDrop:function(event,dayDelta,minuteDelta,revertFunc) {

             setEventForm(event);
	//jQuery('#calendar').fullCalendar('changeView','agendaWeek');                    
                 
         },
         eventClick: function( event, jsEvent, view ){
             if(event.allDay){
                 alert(
                     event.title + " start from " +
                     event.start + " and is all day event "
                 );
             }else{
                 alert(
                     event.title + " start from " +
                     event.start + " and end at " +
                     event.end
                 );
             }
         }
		});
		
		
	});
	
	function setDates(){
		
			var eventObject = {
			  	campaign_id: <?=$campaign['id'];?>,
				title: $.trim($('#cpn_name').val()), // use the element's text as the event title
				cpn_id: $.trim($('#campaign_id').val()),
				start: $.fullCalendar.parseDate($('#cpn_start').val() +'T'+$('#cpn_time_start').val() +'Z'),
				end: $.fullCalendar.parseDate($('#cpn_end').val() +'T'+$('#cpn_time_end').val() +'Z'),
				cpn_start:$('#cpn_start').val(),
				cpn_end:$('#cpn_end').val(),
				cpn_time_start:$('#cpn_time_start').val(),
				cpn_time_end:$('#cpn_time_end').val(),
				user_id: <?=$campaign['user_id']?>,
				color: $('#color').val(),
				allday: $('#allday').is(':checked')
			};
			
			//eventObjects.push(eventObject);
			//$('#eventobjects').val(JSON.stringify(eventObjects));
			
			$.post(base_url + 'ad/schedsave', { "obj": JSON.stringify(eventObject) },
			 function(data){
						alert('Schedule item saved');
				}
				, "json");
			
			//$('#calendar').fullCalendar( 'renderEvent', eventObject, true );
			$('#calendar').fullCalendar( 'refetchEvents' );
			$('#calendar').fullCalendar( 'rerenderEvents' );
	}
	
	function setEventForm(event){
        alert(
            "The end date of " + event.title + "has been moved to " +
            event.start + " to " +
            event.end
        );
        
        jQuery('#cpn_id').val(event.cpn_id);
        jQuery('#title').val(event.title);
        jQuery('#start').val($.fullCalendar.formatDate( event.start, "yyyy-MM-dd" ));
        jQuery('#end').val($.fullCalendar.formatDate( event.end, "yyyy-MM-dd" ));
        jQuery('#allday').val(event.allday);
	}

</script>

<?php
	//print_r($campaign);
?>

    <style type='text/css'>

    	#external-events {
    		float: left;
    		width: 150px;
    		padding: 10px;
    		border: 1px solid #ccc;
    		background: #eee;
    		text-align: left;
    		margin-bottom: 10px;
    		}

    	#external-events h4 {
    		font-size: 14px;
    		font-weight: bold;
    		margin-top: 0;
    		padding-top: 1em;
    		}

    	.external-event { /* try to mimick the look of a real event */
    		margin: 3px 0;
    		padding: 2px 4px;
    		background: #3366CC;
    		color: #fff;
    		font-size: .85em;
    		cursor: pointer;
    		}

    	#external-events p {
    		margin: 1.5em 0;
    		font-size: 11px;
    		color: #666;
    		}

    	#external-events p input {
    		margin: 0;
    		vertical-align: middle;
    		}

    </style>
<!--
    <div id='external-events'>
        <h4>Campaigns</h4>
        <div class='external-event' ref="<?=$campaign['id']?>"><?=$campaign['cpn_name']?></div>
    </div>
-->
<?php print form_open_multipart('ad/schedule/'.$this->validation->id,array('class'=>'horizontal'))?>
    <fieldset>
        <ol>
		        <li>
		            <?php print form_label('Campaign ID','campaign_id')?>
					<?=$this->validation->campaign_id;?>
					<input type="hidden" value="<?=$this->validation->campaign_id;?>" name="campaign_id" id="campaign_id" />
					<input type="hidden" value="<?=$this->validation->cpn_name;?>" name="cpn_name" id="cpn_name" />
		        </li>
		        <li>
		            <?php print form_label('Campaign Dates','cpn_start')?>
		            From <?php print form_input('cpn_start',$this->validation->cpn_start,'id="cpn_start" class="text"')?>
		            To <?php print form_input('cpn_end',$this->validation->cpn_end,'id="cpn_end" class="text"')?>
		        </li>
		        <li>
		            <?php print form_label('Time Range','cpn_time_start')?>
		            From <?php print form_input('cpn_time_start',$this->validation->cpn_time_start,'id="cpn_time_start" class="text"')?>
		            To <?php print form_input('cpn_time_end',$this->validation->cpn_time_end,'id="cpn_time_end" class="text"')?>
								<?php print form_checkbox('allday',1,$this->validation->set_checkbox('allday',1),'id="allday"')?> All day
		        </li>
		        <li>
		            <?php print form_label('In-Schedule Color','color')?>
		            <?php print form_input('color',$this->validation->color,'id="color" class="iColorPicker" class="text"')?>
		        </li>
            <li class="submit">
                <?php print form_hidden('id',$this->validation->id)?>
                <input type="hidden" value="0" id="title" name="title" />
                <input type="hidden" value="0" id="start" name="start" />
                <input type="hidden" value="0" id="end" name="end" />
                <input type="hidden" value="0" id="allday" name="allday" />
                <input type="hidden" value="0" id="cpn_id" name="cpn_id" />
                <input type="hidden" value="0" id="eventobjects" name="eventobjects" />
                <div class="buttons">
		                <a href="<?php print  site_url('ad')?>" class="negative">
		                	<?php print  $this->bep_assets->icon('cross');?>
		                	<?php print $this->lang->line('general_cancel')?>
		                </a>
		
		                <button type="button" class="negative"
											onClick="javascript:setDates();"
											>
		                	<?php print  $this->bep_assets->icon('tick');?>
											Set New Dates
		                </button>

                        <?php if($update == false):?>
                            <button type="submit" class="positive" name="submit" value="submit">
                            	<?php print  $this->bep_assets->icon('group');?>
                            	Set Audience
                            </button>
                        <?php else: ?>
    		                <a href="<?php print  site_url('ad')?>" class="positive">
    		                	<?php print  $this->bep_assets->icon('tick');?>
    		                	Back to Campaign
    		                </a>
                        <?php endif;?>

                </div>
            </li>
        </ol>
    </fieldset>
<?php print form_close()?>

<div class="clear"></div>
<br /><br />

<div id="calendar"></div>
